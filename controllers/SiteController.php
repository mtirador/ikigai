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
            // Obtengo las entradas de diario más recientes en orden ascendente
            $entradas = \app\models\Entradas::find()->orderBy(['fechaentrada' => SORT_ASC])->limit(6)->all();
        } catch (\Exception $e) {
            Yii::error('Error al recuperar las entradas de diario: ' . $e->getMessage());
            $entradas = [];
        }

        // Llamo a la acción para contar las entradas positivas y negativas
        // $countResult = $this->actionGraficoEntradas();

        return $this->render('index', [
                    'entradas' => $entradas,
                        // 'positivas' => $countResult['positivas'],
                        // 'negativas' => $countResult['negativas'],
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

    /* mi primera explotacion de datos con los datos detallados de las ultimas 6 entradas del diario */

    public function actionView($id) {
        // Buscar la entrada por su ID
        $entrada = Entradas::findOne($id);

        // Verificar si la entrada existe
        if (!$entrada) {
            throw new \yii\web\NotFoundHttpException("La entrada con el ID $id no existe.");
        }

        //Cargar los pensamientos asociados a esta entrada
        $pensamientos = $entrada->getCodpens()->all();
        //cargar las emociones asociadas a esta entrada
        $emociones = $entrada->getCodemos()->all();

        $sensaciones = $entrada->getCodsensas()->all();

        return $this->render('vista_detalles', [
                    'entrada' => $entrada,
                    'pensamientos' => $pensamientos,
                    'sensaciones' => $sensaciones,
                    'emociones' => $emociones,
        ]);
    }

    /* Gráfica para obtener las últimas 6 entradas */

    public function actionGraficoEntradas() {
        try {
            // Obtener las entradas de diario más recientes
            $entradas = \app\models\Entradas::find()->orderBy(['fechaentrada' => SORT_ASC])->limit(6)->all();

            //cont para las entradas positivas y negativas
            $positivas = 0;
            $negativas = 0;
            //contar la cantidad de entradas positivas y negativas
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

        //retorno un arreglo asociativo con los conteos de entradas positivas y negativas 
        return [
            'positivas' => $positivas,
            'negativas' => $negativas,
        ];
    }

    public function actionInformacion() {

        return $this->render('informacion');
    }

    /* Conteo de pensamientos positivos y negativos(GRÁFICAS) */

    public function actionEstadisticas() {
        // Obtener el recuento de entradas positivas y negativas
        $countResult = $this->actionGraficoEntradas();

        // Renderizar la vista de estadísticas y pasar los datos del gráfico como parámetros
        return $this->render('estadisticas', [
                    'positivas' => $countResult['positivas'],
                    'negativas' => $countResult['negativas'],
        ]);
    }

    /* Lógica que cuenta los objetivos que estan completados y los que no estan completados (PARA LAS GRÁFICAS) */

    public function actionObjetivos() {
        try {
            // Obtener los objetivos más recientes
            $objetivos = Objetivos::find()->orderBy(['fechalimite' => SORT_DESC])->all();

            // Contadores para objetivos completados y no completados
            $completados = 0;
            $noCompletados = 0;

            // Contar la cantidad de objetivos completados y no completados
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

        // Retornar un arreglo asociativo con los conteos de objetivos completados y no completados
        return [
            'completados' => $completados,
            'noCompletados' => $noCompletados,
        ];
    }

    public function actionSobremi() {
        return $this->render('sobremi');
    }

    /* Acción que renderiza los detalles de las entradas */

    public function actionVistaDetalles($fecha) {
        // Validar que la fecha no esté vacía
        if (empty($fecha)) {
            throw new \yii\web\BadRequestHttpException('Fecha no proporcionada.');
        }

        // Buscar la entrada por fecha
        $entrada = Entradas::findOne(['fechaentrada' => $fecha]);

        // Validar que la entrada exista
        if ($entrada === null) {
            throw new \yii\web\NotFoundHttpException('La entrada no existe.');
        }

        // Obtener los pensamientos asociados a esta entrada
        $pensamientos = $entrada->getCodpens()->all();
        // Obtener las emociones asociadas a esta entrada
        $emociones = $entrada->getCodemos()->all();
        // Obtener las sensaciones asociadas a esta entrada
        $sensaciones = $entrada->getCodsensas()->all();

        // Renderizar la vista con los detalles de la entrada, los pensamientos, las emociones y las sensaciones
        return $this->render('vista_detalles', [
                    'entrada' => $entrada,
                    'pensamientos' => $pensamientos,
                    'emociones' => $emociones,
                    'sensaciones' => $sensaciones,
        ]);
    }

    /* Lógica para la creación del PDF */

    public function actionDownloadPdf($id) {
        $entrada = Entradas::findOne($id);
        if (!$entrada) {
            throw new \yii\web\NotFoundHttpException("La entrada con el ID $id no existe.");
        }

        $pensamientos = $entrada->getCodpens()->all();
        $emociones = $entrada->getCodemos()->all();
        $sensaciones = $entrada->getCodsensas()->all();

        // Renderiza la vista para el PDF
        $content = $this->renderPartial('entrada-pdf', [
            'entrada' => $entrada,
            'pensamientos' => $pensamientos,
            'emociones' => $emociones,
            'sensaciones' => $sensaciones,
        ]);

        // Configuración del componente mPDF
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

        // Devuelve el PDF generado al navegador
        return $pdf->render();
    }

}
