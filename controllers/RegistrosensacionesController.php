<?php

namespace app\controllers;

use app\models\Registrosensaciones;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegistrosensacionesController implements the CRUD actions for Registrosensaciones model.
 */
class RegistrosensacionesController extends Controller
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
     * Lists all Registrosensaciones models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Registrosensaciones::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'regsensa' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Registrosensaciones model.
     * @param int $regsensa Regsensa
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($regsensa)
    {
        return $this->render('view', [
            'model' => $this->findModel($regsensa),
        ]);
    }

    /**
     * Creates a new Registrosensaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Registrosensaciones();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'regsensa' => $model->regsensa]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Registrosensaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $regsensa Regsensa
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($regsensa)
    {
        $model = $this->findModel($regsensa);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'regsensa' => $model->regsensa]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Registrosensaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $regsensa Regsensa
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($regsensa)
    {
        $this->findModel($regsensa)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Registrosensaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $regsensa Regsensa
     * @return Registrosensaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($regsensa)
    {
        if (($model = Registrosensaciones::findOne(['regsensa' => $regsensa])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
