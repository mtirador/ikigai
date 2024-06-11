<?php

use app\models\Registroemociones;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Registroemociones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registroemociones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Registroemociones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'regemo',
            'identrada',
            'codemo',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Registroemociones $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'regemo' => $model->regemo]);
                 }
            ],
        ],
    ]); ?>


</div>
