<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Registroemociones $model */

$this->title = $model->regemo;
$this->params['breadcrumbs'][] = ['label' => 'Registroemociones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="registroemociones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'regemo' => $model->regemo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'regemo' => $model->regemo], [
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
            'regemo',
            'identrada',
            'codemo',
        ],
    ]) ?>

</div>
