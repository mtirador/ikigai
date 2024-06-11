<?php

use app\models\Emociones;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Emociones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emociones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Emociones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codemo',
            'intensidad',
            'agradable',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Emociones $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'codemo' => $model->codemo]);
                 }
            ],
        ],
    ]); ?>


</div>
