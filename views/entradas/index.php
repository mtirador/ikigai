<?php

use app\models\Entradas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Entradas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entradas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Entradas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'identrada',
            'titulo',
            'descripcion',
            'fechaentrada',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Entradas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'identrada' => $model->identrada]);
                 }
            ],
        ],
    ]); ?>


</div>
