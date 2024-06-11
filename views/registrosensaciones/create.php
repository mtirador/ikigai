<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Registrosensaciones $model */

$this->title = 'Create Registrosensaciones';
$this->params['breadcrumbs'][] = ['label' => 'Registrosensaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registrosensaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
