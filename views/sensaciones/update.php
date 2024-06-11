<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Sensaciones $model */

$this->title = 'Update Sensaciones: ' . $model->codsensa;
$this->params['breadcrumbs'][] = ['label' => 'Sensaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codsensa, 'url' => ['view', 'codsensa' => $model->codsensa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sensaciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
