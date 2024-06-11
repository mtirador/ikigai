<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use mihaildev\ckeditor\CKEditor; // Importar la clase CKEditor

/* @var $this yii\web\View */
/* @var $model app\models\Entradas */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile(Url::to('@web/css/entradasForm.css'));
?>

<div class="row">
    <div class="col-md-6"> 
        <div class="page-title">
            <h1>¿Cómo estás?</h1>
        </div>
        
        <div class="entradas-form">
            <!-- Agregar bloque para mostrar mensaje flash -->
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success">
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'titulo')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese un título (máx. 100 caracteres)','maxlength' => 100]) ?>

            <?= $form->field($model, 'descripcion')->widget(CKEditor::class, [
                'editorOptions' => [
                    'preset' => 'standard',
                    'inline' => false,
                    'placeholder' => 'Detalla tu día (máx. 2500 caracteres)', // Agregar el placeholder
                ],
            ])->label(false) ?>

            <?= $form->field($model, 'fechaentrada')->textInput(['type' => 'date', 'value' => date('Y-m-d'), 'readonly' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['id' => 'guardar-btn', 'class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="col-md-6">
        <img src="<?= Url::to('@web/images/diario2.png') ?>" alt="Diario" class="imagen-formulario">
    </div>
</div>

<div id="popup-confirmacion" class="popup" style="display: none;">
    <div class="popup-tarjeta">
        <div class="popup-contenido">
            <p>¿Está seguro de que desea guardar?</p>
            <div class="opciones">
                <button id="confirmar-guardar" class="btn-primary">Guardar</button>
                <button id="cancelar-guardar" class="btn-danger">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJsFile('@web/js/confirmation.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<?php
// JavaScript para limitar la cantidad de caracteres en CKEditor
$this->registerJs("
    $(document).ready(function(){
        var editor = CKEDITOR.instances['" . Html::getInputId($model, 'descripcion') . "'];

        editor.on('change', function() {
            var text = editor.getData();
            var decodedText = $('<div/>').html(text).text(); // Decodificar HTML entities
            var maxLength = 2500;
            if (decodedText.length > maxLength) {
                var newText = decodedText.substring(0, maxLength);
                editor.setData(newText);
            }
        });
    });
");
?>
