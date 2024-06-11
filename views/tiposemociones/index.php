<?php

use app\models\Tiposemociones;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tiposemociones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tiposemociones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tiposemociones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idtipos',
            'codemo',
            'tipos',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tiposemociones $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idtipos' => $model->idtipos]);
                 }
            ],
        ],
    ]); ?>


</div>
