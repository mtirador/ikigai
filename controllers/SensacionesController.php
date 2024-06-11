<?php

namespace app\controllers;

use Yii;
use app\models\Sensaciones;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Registrosensaciones;

/**
 * SensacionesController implements the CRUD actions for Sensaciones model.
 */
class SensacionesController extends Controller
{
    /**
     * @inheritDoc
     */
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

    /**
     * Lists all Sensaciones models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Sensaciones::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'codsensa' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sensaciones model.
     * @param int $codsensa Codsensa
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($codsensa)
    {
        return $this->render('view', [
            'model' => $this->findModel($codsensa),
        ]);
    }

    /**
     * Creates a new Sensaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
   public function actionCreate($identrada = null)
{
    if ($identrada === null) {
        throw new \yii\web\BadRequestHttpException('Parámetro requerido "identrada" está ausente.');
    }

    $model = new Sensaciones();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        // Establecer la relación con la entrada
        $registroSensaciones = new Registrosensaciones();
        $registroSensaciones->identrada = $identrada;
        $registroSensaciones->codsensa = $model->codsensa;
        $registroSensaciones->save();

        Yii::$app->session->setFlash('success', 'Sensación guardada correctamente.');
        return $this->redirect(['entradas/diario', 'id' => $identrada]);
    }

    return $this->render('create', [
        'model' => $model,
        'identrada' => $identrada,
    ]);
}



    /**
     * Updates an existing Sensaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $codsensa Codsensa
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($codsensa)
    {
        $model = $this->findModel($codsensa);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codsensa' => $model->codsensa]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sensaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $codsensa Codsensa
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($codsensa)
    {
        $this->findModel($codsensa)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sensaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $codsensa Codsensa
     * @return Sensaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($codsensa)
    {
        if (($model = Sensaciones::findOne(['codsensa' => $codsensa])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
