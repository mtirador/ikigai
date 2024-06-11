<?php

use app\models\Objetivos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Objetivos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetivos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Establecer nuevos Objetivos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'codobj',
            'denominacion',
            'fechalimite',
            'descripcion',
            'completado',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Objetivos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'codobj' => $model->codobj]);
                 }
            ],
        ],
    ]); ?>


</div>
