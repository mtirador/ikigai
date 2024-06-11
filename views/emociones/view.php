<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Emociones $model */

$this->title = $model->codemo;
$this->params['breadcrumbs'][] = ['label' => 'Emociones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="emociones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'codemo' => $model->codemo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'codemo' => $model->codemo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codemo',
            'intensidad',
            'agradable',
        ],
    ]) ?>

</div>
