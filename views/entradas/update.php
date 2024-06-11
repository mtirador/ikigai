<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Entradas $model */

$this->title = 'Update Entradas: ' . $model->identrada;
$this->params['breadcrumbs'][] = ['label' => 'Entradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->identrada, 'url' => ['view', 'identrada' => $model->identrada]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="entradas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
