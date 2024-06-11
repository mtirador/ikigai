<?php

namespace app\controllers;

use Yii;
use app\models\Entradas;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EntradasController implements the CRUD actions for Entradas model.
 */
class EntradasController extends Controller
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
     * Lists all Entradas models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Entradas::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'identrada' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Entradas model.
     * @param int $identrada Identrada
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
   
public function actionView($identrada)
{
    $model = $this->findModel($identrada);
    $editModel = new Entradas(); 

    if ($editModel->load(Yii::$app->request->post()) && $editModel->save()) {
        Yii::$app->session->setFlash('success', 'Entrada actualizada correctamente.');
        return $this->redirect(['view', 'identrada' => $editModel->identrada]);
    }

    return $this->render('view', [
        'model' => $model,
        'editModel' => $editModel,
    ]);
}


    /**
     * Creates a new Entradas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Entradas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Entrada guardada correctamente.');
            return $this->redirect(['view', 'identrada' => $model->identrada]);
        }

        return $this->render('entradasform', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Entradas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $identrada Identrada
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($identrada)
    {
        $model = $this->findModel($identrada);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'identrada' => $model->identrada]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

  
    /**
 * Deletes an existing Entradas model.
 * If deletion is successful, the browser will be redirected to the 'diario' page.
 * @param int $identrada Identrada
 * @return \yii\web\Response
 * @throws NotFoundHttpException if the model cannot be found
 */
public function actionDelete($identrada)
{
    $model = $this->findModel($identrada);
    $model->delete();

    // confirmation flash
    Yii::$app->session->setFlash('success', 'Entrada eliminada correctamente.');

    return $this->redirect(['diario']);
}


    /**
     * Finds the Entradas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $identrada Identrada
     * @return Entradas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($identrada)
    {
        if (($model = Entradas::findOne(['identrada' => $identrada])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
  public function actionContinuar($identrada)
{
    // Redirect to the thought creation form and pass the entry ID as a GET parameter
    return $this->redirect(['pensamientos/create', 'identrada' => $identrada]);
}

public function actionDiario()
{
    return $this->render('diario');
}


public function actionCheckAndCreate()
{
    $today = date('Y-m-d');
    $existingEntry = Entradas::find()
        ->where(['fechaentrada' => $today])
        ->one();

    if ($existingEntry) {
        return $this->asJson(['exists' => true]);
    } else {
        return $this->asJson(['exists' => false]);
    }
}




}
