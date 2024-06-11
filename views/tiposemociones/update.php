<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tiposemociones $model */

$this->title = 'Update Tiposemociones: ' . $model->idtipos;
$this->params['breadcrumbs'][] = ['label' => 'Tiposemociones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtipos, 'url' => ['view', 'idtipos' => $model->idtipos]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tiposemociones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
