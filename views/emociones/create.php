<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Emociones $model */
/** @var yii\widgets\ActiveForm $form */
$this->registerCssFile(Yii::$app->request->baseUrl . '/css/createEmociones.css');
$this->title = 'Registrar Emociones';
$this->params['breadcrumbs'][] = ['label' => 'Emociones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="emociones-create">
    <div class="row">
        <!-- Columna para el formulario -->
        <div class="col-md-6">
            <div class="tarjeta customizable">
                <div class="card-body-emociones">
                  
                    <!-- Formulario de registro de emociones -->
                    <?php $form = ActiveForm::begin(); ?>
                    <h2 class="titulo-emociones">Registrar Emociones</h2>
                    
                    <!-- Campo oculto para capturar el identificador de la entrada -->
                    <?= Html::hiddenInput('identrada', $identrada) ?>
                    
                    <!-- Campo para la intensidad -->
                    <div class="form-group">
                        <label class="control-label" for="emociones-intensidad"></label>
                        <!-- Campo para la intensidad -->
                        <?= $form->field($model, 'intensidad')->textInput(['id' => 'emociones-intensidad'])->input('text', ['placeholder' => 'Ingrese el nivel de intensidad (máximo 100 caracteres)', 'class' => 'form-control', 'maxlength' => 100]) ?>

                    </div>
                    
                    <!-- Campo para si es agradable o no -->
                    <div class="form-group">
                        <div class="checkbox">
                            <?= Html::checkbox('Emociones[agradable]', null, ['label' => '¿Es agradable?(marca en caso afirmativo)']) ?>
                        </div>
                    </div>
                    
                    <!-- Campo para los tipos de emociones -->
                   <div class="form-group">
    <label class="control-label" for="emociones-tipo-emociones">Tipos de Emociones</label>
    <div class="row">
        <?php 
        // Obtener todas las emociones sin repetir
        $tiposEmociones = array_unique(array_column(\app\models\Tiposemociones::find()->limit(50)->asArray()->all(), 'tipos'));
        
        // Dividir las emociones en columnas
        $chunkedTiposEmociones = array_chunk($tiposEmociones, ceil(count($tiposEmociones) / 3));
        ?>
        <?php foreach ($chunkedTiposEmociones as $columna): ?>
            <div class="col-sm-4">
                <?php foreach ($columna as $tipoEmocion): ?>
                    <div class="checkbox">
                        <?= Html::checkbox('Emociones[tipoEmociones][]', null, ['label' => $tipoEmocion, 'value' => $tipoEmocion]) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>


                    
                    <!-- Botón de guardar -->
                    <div class="form-group">
                        <?= Html::button('Guardar', ['class' => 'btn btn-success', 'id' => 'guardar-btn']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <!-- Columna para la imagen -->
        <div class="col-md-6">
            <img src="<?= Url::to('@web/images/3.png') ?>" alt="Emociones" class="imagen-formulario">
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

<script>
    // Script para manejar el pop-up de confirmación al hacer clic en el botón de guardar
    document.getElementById('guardar-btn').addEventListener('
