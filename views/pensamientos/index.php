<?php

use app\models\Pensamientos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pensamientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pensamientos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pensamientos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'codpen',
            'intrusivo',
            'recurrente',
            'positivo',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pensamientos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'codpen' => $model->codpen]);
                 }
            ],
        ],
    ]); ?>


</div>
