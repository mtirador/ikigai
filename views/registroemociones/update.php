<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Registroemociones $model */

$this->title = 'Update Registroemociones: ' . $model->regemo;
$this->params['breadcrumbs'][] = ['label' => 'Registroemociones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->regemo, 'url' => ['view', 'regemo' => $model->regemo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registroemociones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
