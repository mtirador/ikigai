<?php

use app\models\Registrosensaciones;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Registrosensaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registrosensaciones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Registrosensaciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'regsensa',
            'identrada',
            'codsensa',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Registrosensaciones $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'regsensa' => $model->regsensa]);
                 }
            ],
        ],
    ]); ?>


</div>
