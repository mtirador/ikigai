<?php

namespace app\controllers;

use Yii;
use app\models\Emociones;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Registroemociones;
use app\models\Tiposemociones;

/**
 * EmocionesController implements the CRUD actions for Emociones model.
 */
class EmocionesController extends Controller {

    /**
     * @inheritDoc
     */
    public function behaviors() {
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
     * Lists all Emociones models.
     *
     * @return string
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Emociones::find(),
                /*
                  'pagination' => [
                  'pageSize' => 50
                  ],
                  'sort' => [
                  'defaultOrder' => [
                  'codemo' => SORT_DESC,
                  ]
                  ],
                 */
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Emociones model.
     * @param int $codemo Codemo
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($codemo) {
        return $this->render('view', [
                    'model' => $this->findModel($codemo),
        ]);
    }

    /**
     * Creates a new Emociones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($identrada) {
        $model = new Emociones();

        if ($model->load(Yii::$app->request->post())) {
            // Check if 'tipoEmociones' is defined in the POST request
            $postData = Yii::$app->request->post('Emociones');
            if (isset($postData['tipoEmociones'])) {
                $model->tipoEmociones = $postData['tipoEmociones'];
            } else {
                $model->tipoEmociones = []; // Assign an empty array if it is not defined

            }

            if ($model->save()) {
                // Set the relationship with the entry
                $registroEmociones = new Registroemociones();
                $registroEmociones->identrada = $identrada;
                $registroEmociones->codemo = $model->codemo; // Use the saved emotion code
                $registroEmociones->save();

                // Save the selected emotion types
                if (!empty($model->tipoEmociones)) {
                    foreach ($model->tipoEmociones as $tipoId) {
                        $registroTiposEmociones = new Tiposemociones(); 
                        $registroTiposEmociones->codemo = $model->codemo;
                        $registroTiposEmociones->tipos = $tipoId; 
                        $registroTiposEmociones->save();
                    }
                }

                Yii::$app->session->setFlash('success', 'Emoción guardada correctamente.');
                
                return $this->redirect(['sensaciones/create', 'identrada' => $identrada]);
            }
        }

    // Filter the emotion types to exclude those that have already been selected
        $tiposEmociones = Tiposemociones::find()
                ->where(['not in', 'idtipos', !empty($model->tipoEmociones) ? array_column($model->tipoEmociones, 'idtipos') : []])
                ->all();

        return $this->render('create', [
                    'model' => $model,
                    'identrada' => $identrada,
                    'tiposEmociones' => $tiposEmociones,
        ]);
    }

    /**
     * Updates an existing Emociones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $codemo Codemo
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($codemo) {
        $model = $this->findModel($codemo);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codemo' => $model->codemo]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Emociones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $codemo Codemo
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($codemo) {
        $this->findModel($codemo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Emociones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $codemo Codemo
     * @return Emociones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($codemo) {
        if (($model = Emociones::findOne(['codemo' => $codemo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
