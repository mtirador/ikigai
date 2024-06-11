<?php

namespace app\controllers;

use app\models\Registroemociones;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegistroemocionesController implements the CRUD actions for Registroemociones model.
 */
class RegistroemocionesController extends Controller
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
     * Lists all Registroemociones models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Registroemociones::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'regemo' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Registroemociones model.
     * @param int $regemo Regemo
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($regemo)
    {
        return $this->render('view', [
            'model' => $this->findModel($regemo),
        ]);
    }

    /**
     * Creates a new Registroemociones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Registroemociones();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'regemo' => $model->regemo]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Registroemociones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $regemo Regemo
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($regemo)
    {
        $model = $this->findModel($regemo);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'regemo' => $model->regemo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Registroemociones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $regemo Regemo
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($regemo)
    {
        $this->findModel($regemo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Registroemociones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $regemo Regemo
     * @return Registroemociones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($regemo)
    {
        if (($model = Registroemociones::findOne(['regemo' => $regemo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
