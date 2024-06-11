<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Objetivos $model */

$this->title = 'Establecer nuevos Objetivos';
$this->params['breadcrumbs'][] = ['label' => 'Objetivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetivos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
