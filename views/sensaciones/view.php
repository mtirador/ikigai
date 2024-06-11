<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Sensaciones $model */

$this->title = $model->codsensa;
$this->params['breadcrumbs'][] = ['label' => 'Sensaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sensaciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'codsensa' => $model->codsensa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'codsensa' => $model->codsensa], [
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
            'codsensa',
            'descripcion',
            'denominacion',
            'localizacioncorporal',
        ],
    ]) ?>

</div>
