<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Entradas;
use app\models\Objetivos;
use kartik\mpdf\Pdf;

class SiteController extends Controller {
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        try {
            
            $entradas = \app\models\Entradas::find()->orderBy(['fechaentrada' => SORT_ASC])->limit(6)->all();
        } catch (\Exception $e) {
            Yii::error('Error al recuperar las entradas de diario: ' . $e->getMessage());
            $entradas = [];
        }

        return $this->render('index', [
                    'entradas' => $entradas,
              
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionView($id) {
        // Buscar la entrada por su ID
        $entrada = Entradas::findOne($id);

        if (!$entrada) {
            throw new \yii\web\NotFoundHttpException("La entrada con el ID $id no existe.");
        }

        $pensamientos = $entrada->getCodpens()->all();
        
        $emociones = $entrada->getCodemos()->all();

        $sensaciones = $entrada->getCodsensas()->all();

        return $this->render('vista_detalles', [
                    'entrada' => $entrada,
                    'pensamientos' => $pensamientos,
                    'sensaciones' => $sensaciones,
                    'emociones' => $emociones,
        ]);
    }

    public function actionGraficoEntradas() {
        try {

            $entradas = \app\models\Entradas::find()->orderBy(['fechaentrada' => SORT_ASC])->limit(6)->all();

            $positivas = 0;
            $negativas = 0;

            foreach ($entradas as $entrada) {
                $pensamientos = $entrada->getCodpens()->all();
                foreach ($pensamientos as $pensamiento) {
                    if ($pensamiento->positivo == 1) {
                        $positivas++;
                    } else {
                        $negativas++;
                    }
                }
            }
        } catch (\Exception $e) {
            Yii::error('Error al contar las entradas de diario: ' . $e->getMessage());
            $positivas = 0;
            $negativas = 0;
        }

        return [
            'positivas' => $positivas,
            'negativas' => $negativas,
        ];
    }

    public function actionInformacion() {

        return $this->render('informacion');
    }


    public function actionEstadisticas() {
        $countResult = $this->actionGraficoEntradas();

        return $this->render('estadisticas', [
                    'positivas' => $countResult['positivas'],
                    'negativas' => $countResult['negativas'],
        ]);
    }


    public function actionObjetivos() {
        try {
     
            $objetivos = Objetivos::find()->orderBy(['fechalimite' => SORT_DESC])->all();
            $completados = 0;
            $noCompletados = 0;

            foreach ($objetivos as $objetivo) {
                if ($objetivo->completado) {
                    $completados++;
                } else {
                    $noCompletados++;
                }
            }
        } catch (\Exception $e) {
            Yii::error('Error al contar los objetivos: ' . $e->getMessage());
            $completados = 0;
            $noCompletados = 0;
        }
        
        return [
            'completados' => $completados,
            'noCompletados' => $noCompletados,
        ];
    }

    public function actionSobremi() {
        return $this->render('sobremi');
    }


    public function actionVistaDetalles($fecha) {
        if (empty($fecha)) {
            throw new \yii\web\BadRequestHttpException('Fecha no proporcionada.');
        }

        $entrada = Entradas::findOne(['fechaentrada' => $fecha]);

        if ($entrada === null) {
            throw new \yii\web\NotFoundHttpException('La entrada no existe.');
        }

        $pensamientos = $entrada->getCodpens()->all();
        
        $emociones = $entrada->getCodemos()->all();

        $sensaciones = $entrada->getCodsensas()->all();
        return $this->render('vista_detalles', [
                    'entrada' => $entrada,
                    'pensamientos' => $pensamientos,
                    'emociones' => $emociones,
                    'sensaciones' => $sensaciones,
        ]);
    }

    public function actionDownloadPdf($id) {
        $entrada = Entradas::findOne($id);
        if (!$entrada) {
            throw new \yii\web\NotFoundHttpException("La entrada con el ID $id no existe.");
        }

        $pensamientos = $entrada->getCodpens()->all();
        $emociones = $entrada->getCodemos()->all();
        $sensaciones = $entrada->getCodsensas()->all();

        $content = $this->renderPartial('entrada-pdf', [
            'entrada' => $entrada,
            'pensamientos' => $pensamientos,
            'emociones' => $emociones,
            'sensaciones' => $sensaciones,
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'options' => ['title' => 'Detalles de la Entrada'],
            'methods' => [
                'SetHeader' => ['Detalles de la Entrada'],
                'SetFooter' => ['{PAGENO}'],
            ],
        ]);

        return $pdf->render();
    }

}
