<?php

use app\models\Registropensamientos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Registropensamientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registropensamientos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Registropensamientos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'regpen',
            'identrada',
            'codpen',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Registropensamientos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'regpen' => $model->regpen]);
                 }
            ],
        ],
    ]); ?>


</div>
