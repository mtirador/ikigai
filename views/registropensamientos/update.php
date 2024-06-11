<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Registropensamientos $model */

$this->title = 'Update Registropensamientos: ' . $model->regpen;
$this->params['breadcrumbs'][] = ['label' => 'Registropensamientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->regpen, 'url' => ['view', 'regpen' => $model->regpen]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registropensamientos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
