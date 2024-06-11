<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Registrosensaciones $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="registrosensaciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'identrada')->textInput() ?>

    <?= $form->field($model, 'codsensa')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
