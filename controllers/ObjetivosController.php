<?php

namespace app\controllers;

use Yii;
use app\models\Objetivos;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ObjetivosController implements the CRUD actions for Objetivos model.
 */
class ObjetivosController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Objetivos::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($codobj)
    {
        $model = $this->findModel($codobj);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isPost) {
            if ($model->delete()) {
                return $this->redirect(['index']);
            } else {
                // Manejar errores de eliminación aquí
            }
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Objetivos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codobj' => $model->codobj]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($codobj)
    {
        $model = $this->findModel($codobj);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codobj' => $model->codobj]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($codobj)
    {
        $model = $this->findModel($codobj);
        $model->delete();

        $lastCodobj = Objetivos::find()->max('codobj');
        Yii::$app->db->createCommand()->resetSequence('objetivos', $lastCodobj + 1)->execute();

        return $this->redirect(['continuar']);
    }

    protected function findModel($codobj)
    {
        if (($model = Objetivos::findOne(['codobj' => $codobj])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCreateCustom()
    {
        $model = new Objetivos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codobj' => $model->codobj]);
        } else {
            return $this->render('create_custom', [
                'model' => $model,
            ]);
        }
    }

    public function actionContinuar()
    {
        $numeroObjetivosCompletados = Objetivos::find()->where(['completado' => true])->count();
        $proximoObjetivos = Objetivos::find()
            ->where(['>', 'fechalimite', date('Y-m-d')])
            ->andWhere(['completado' => false])
            ->orderBy('fechalimite')
            ->limit(3)
            ->all();

        $model = new Objetivos();

        return $this->render('_afterForm', [
            'proximoObjetivos' => $proximoObjetivos,
            'model' => $model,
            'numeroObjetivosCompletados' => $numeroObjetivosCompletados,
        ]);
    }

    public function actionBuscar($completado)
    {
        $searchResults = Objetivos::find()->where(['completado' => $completado])->all();
        $proximoObjetivos = Objetivos::find()
            ->where(['>', 'fechalimite', date('Y-m-d')])
            ->andWhere(['completado' => false])
            ->orderBy('fechalimite')
            ->limit(3)
            ->all();

        $numeroObjetivosCompletados = Objetivos::find()->where(['completado' => true])->count();
        $model = new Objetivos();

        return $this->render('_afterForm', [
            'searchResults' => $searchResults,
            'proximoObjetivos' => $proximoObjetivos,
            'model' => $model,
            'numeroObjetivosCompletados' => $numeroObjetivosCompletados,
        ]);
    }

    public function actionMarcar($codobj)
{
    $model = $this->findModel($codobj);
    $model->completado = true;

    if ($model->save()) {
        Yii::$app->session->setFlash('success', 'El objetivo se marcó como completado correctamente.');

        $numeroObjetivosCompletados = Objetivos::find()->where(['completado' => true])->count();

        // Desbloquear recompensas
        $this->desbloquearRecompensas($numeroObjetivosCompletados);
    } else {
        Yii::$app->session->setFlash('error', 'Hubo un error al marcar el objetivo como completado.');
    }

    return $this->redirect(['continuar']);
}

private function desbloquearRecompensas($numeroObjetivosCompletados)
{
    $recompensasDesbloqueadas = [
        1 => false,
        2 => false,
        3 => false,
        4 => false,
        5 => false
    ];

    if ($numeroObjetivosCompletados >= 1) {
        $recompensasDesbloqueadas[1] = true;
    }
    if ($numeroObjetivosCompletados >= 5) {
        $recompensasDesbloqueadas[2] = true;
    }
    if ($numeroObjetivosCompletados >= 10) {
        $recompensasDesbloqueadas[3] = true;
    }
    if ($numeroObjetivosCompletados >= 12) {
        $recompensasDesbloqueadas[4] = true;
    }
    if ($numeroObjetivosCompletados >= 15) {
        $recompensasDesbloqueadas[5] = true;
    }

    // Guardar el estado de las recompensas en la sesión
    foreach ($recompensasDesbloqueadas as $recompensa => $desbloqueada) {
        Yii::$app->session->set('recompensa' . $recompensa, $desbloqueada);
    }
}


    public function actionDesmarcar($codobj)
    {
        $model = $this->findModel($codobj);
        $model->completado = false;

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'El objetivo se desmarcó como completado correctamente.');
        } else {
            Yii::$app->session->setFlash('error', 'Hubo un error al desmarcar el objetivo como completado.');
        }

        return $this->redirect(['continuar']);
    }

   
}
