<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tiposemociones $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tiposemociones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codemo')->textInput() ?>

    <?= $form->field($model, 'tipos')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
