<?php

namespace app\controllers;

use app\models\Registropensamientos;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegistropensamientosController implements the CRUD actions for Registropensamientos model.
 */
class RegistropensamientosController extends Controller
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
     * Lists all Registropensamientos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Registropensamientos::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'regpen' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Registropensamientos model.
     * @param int $regpen Regpen
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($regpen)
    {
        return $this->render('view', [
            'model' => $this->findModel($regpen),
        ]);
    }

    /**
     * Creates a new Registropensamientos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Registropensamientos();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'regpen' => $model->regpen]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Registropensamientos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $regpen Regpen
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($regpen)
    {
        $model = $this->findModel($regpen);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'regpen' => $model->regpen]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Registropensamientos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $regpen Regpen
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($regpen)
    {
        $this->findModel($regpen)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Registropensamientos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $regpen Regpen
     * @return Registropensamientos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($regpen)
    {
        if (($model = Registropensamientos::findOne(['regpen' => $regpen])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
