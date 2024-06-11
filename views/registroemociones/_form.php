<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Registroemociones $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="registroemociones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'identrada')->textInput() ?>

    <?= $form->field($model, 'codemo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
