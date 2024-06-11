<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Emociones $model */

$this->title = 'Update Emociones: ' . $model->codemo;
$this->params['breadcrumbs'][] = ['label' => 'Emociones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codemo, 'url' => ['view', 'codemo' => $model->codemo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="emociones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
