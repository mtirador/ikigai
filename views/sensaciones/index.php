<?php

use app\models\Sensaciones;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sensaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sensaciones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sensaciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codsensa',
            'descripcion',
            'denominacion',
            'localizacioncorporal',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Sensaciones $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'codsensa' => $model->codsensa]);
                 }
            ],
        ],
    ]); ?>


</div>
