<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Registropensamientos $model */

$this->title = 'Create Registropensamientos';
$this->params['breadcrumbs'][] = ['label' => 'Registropensamientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registropensamientos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
