<?php

namespace app\controllers;
use yii;
use app\models\Entradas;
use app\models\Pensamientos;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
   use app\models\Registropensamientos;


/**
 * PensamientosController implements the CRUD actions for Pensamientos model.
 */
class PensamientosController extends Controller
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
     * Lists all Pensamientos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pensamientos::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'codpen' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pensamientos model.
     * @param int $codpen Codpen
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($codpen)
    {
        return $this->render('view', [
            'model' => $this->findModel($codpen),
        ]);
    }

    /**
     * Creates a new Pensamientos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */


public function actionCreate($identrada)
{
    $model = new Pensamientos();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
       
        $registroPensamientos = new Registropensamientos();
        $registroPensamientos->identrada = $identrada;
        $registroPensamientos->codpen = $model->codpen; 
        $registroPensamientos->save();

        Yii::$app->session->setFlash('success', 'Pensamiento guardado correctamente.');
        
       
        return $this->redirect(['emociones/create', 'identrada' => $identrada]);
    }

    return $this->render('create', [
        'model' => $model,
        'identrada' => $identrada, 
    ]);
}






    /**
     * Updates an existing Pensamientos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $codpen Codpen
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($codpen)
    {
        $model = $this->findModel($codpen);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'codpen' => $model->codpen]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pensamientos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $codpen Codpen
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($codpen)
    {
        $this->findModel($codpen)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pensamientos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $codpen Codpen
     * @return Pensamientos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($codpen)
    {
        if (($model = Pensamientos::findOne(['codpen' => $codpen])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
