<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tiposemociones $model */

$this->title = $model->idtipos;
$this->params['breadcrumbs'][] = ['label' => 'Tiposemociones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tiposemociones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idtipos' => $model->idtipos], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idtipos' => $model->idtipos], [
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
            'idtipos',
            'codemo',
            'tipos',
        ],
    ]) ?>

</div>
