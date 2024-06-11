<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Registrosensaciones $model */

$this->title = $model->regsensa;
$this->params['breadcrumbs'][] = ['label' => 'Registrosensaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="registrosensaciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'regsensa' => $model->regsensa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'regsensa' => $model->regsensa], [
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
            'regsensa',
            'identrada',
            'codsensa',
        ],
    ]) ?>

</div>
