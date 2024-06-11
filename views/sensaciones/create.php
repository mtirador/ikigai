<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Sensaciones $model */
/** @var yii\widgets\ActiveForm $form */
$this->registerCssFile(Yii::$app->request->baseUrl . '/css/createSensaciones.css');
$this->title = 'Registrar Sensaciones';
$this->params['breadcrumbs'][] = ['label' => 'Sensaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sensaciones-create">
    <div class="row">
        <div class="col-md-6">
            <div class="tarjeta customizable">
                <div class="card-body-sensaciones">
                    <!-- Agregar bloque para mostrar mensaje flash -->
                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                   
                    <?php endif; ?>

                    <?php $form = ActiveForm::begin(); ?>
                    <h2 class="titulo-sensaciones">Registrar Sensaciones</h2>
                    
                    <!-- Campo oculto para capturar el identificador de la entrada -->
                    <?= Html::hiddenInput('identrada', $identrada) ?>
                    
                    <!-- Campo para la descripción -->
                    <?= $form->field($model, 'descripcion')->textarea(['rows' => 4, 'placeholder' => 'Ingrese una descripción (máx. 500 caracteres)', 'maxlength' => 500])->label('Descripción') ?>
                    
                    <!-- Campo para la denominación -->
                    <?= $form->field($model, 'denominacion')->textarea(['rows' => 4, 'placeholder' => 'Ingrese una denominación (pesadez, temblores, relax, taquicardias...)', 'maxlength' => 500])->label('Denominación') ?>
                    
                    <!-- Campo para la localización corporal -->
                    <?= $form->field($model, 'localizacioncorporal')->textarea(['rows' => 4, 'placeholder' => 'Ingrese la localización corporal (máx. 500 caracteres)', 'maxlength' => 500])->label('Localización Corporal') ?>
                    
                    <!-- Botón de guardar -->
                    <div class="form-group">
                        <?= Html::button('Guardar', ['class' => 'btn btn-success', 'id' => 'guardar-btn']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <img src="<?= Url::to('@web/images/floresCerezo.png') ?>" alt="Sensaciones" class="imagen-formulario">
        </div>
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
// Incluye el archivo JavaScript de confirmación
$this->registerJsFile('@web/js/confirmation.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
