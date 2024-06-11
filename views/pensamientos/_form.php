<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pensamientos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pensamientos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'intrusivo')->textInput() ?>

    <?= $form->field($model, 'recurrente')->textInput() ?>

    <?= $form->field($model, 'positivo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
