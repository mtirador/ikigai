<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Emociones $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="emociones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'intensidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agradable')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
