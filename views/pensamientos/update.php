<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pensamientos $model */

$this->title = 'Update Pensamientos: ' . $model->codpen;
$this->params['breadcrumbs'][] = ['label' => 'Pensamientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codpen, 'url' => ['view', 'codpen' => $model->codpen]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pensamientos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
