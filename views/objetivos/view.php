<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Objetivos */

$this->registerCssFile(Url::to('@web/css/formulario.css'));
$this->title = $model->denominacion;
$this->params['breadcrumbs'][] = ['label' => 'Objetivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);

// Registro de script JS para el popup de confirmación
$js = <<< JS
$(document).ready(function(){
    $('#eliminar-btn').on('click', function(e) {
        e.preventDefault(); // Evita que el enlace funcione normalmente
        $('#popup-confirmacion').fadeIn(); // Mostrar el popup de confirmación
    });

    $('#confirmar-eliminar').on('click', function() {
        $('#popup-confirmacion').fadeOut(); // Ocultar el popup de confirmación
        window.location.href = $('#eliminar-btn').attr('href'); // Redirigir al enlace de eliminación
    });

    $('#cancelar-eliminar').on('click', function() {
        $('#popup-confirmacion').fadeOut(); // Ocultar el popup de confirmación
    });

    // Mostrar u ocultar los campos de edición al hacer clic en el botón Editar
    $('#editar-btn').click(function() {
        $('#editar-campos').slideToggle();
    });
});
JS;
$this->registerJs($js);
?>

<!-- Popup de confirmación -->
<div id="popup-confirmacion" class="popup">
    <div class="popup-tarjeta">
        <div class="popup-contenido">
            <p>¿Estás seguro de que deseas eliminar este objetivo?</p>
            <div class="opciones">
                <button id="confirmar-eliminar" class="btn-continuar">Sí</button>
                <button id="cancelar-eliminar" class="btn-cancelar">No</button>
            </div>
        </div>
    </div>
</div>


<!-- Vista de Objetivos -->
<div class="objetivos-view">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="titulo-objetivo">
                    <h2 class="texto-titulo">¿Deseas hacer algún cambio?</h2>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title"><?= Html::encode($model->denominacion) ?></h2>
                        <p class="card-data">Fecha límite: <?= Yii::$app->formatter->asDate($model->fechalimite, 'php:d-m-Y') ?></p>
                        <p class="card-data"><?= Html::encode($model->descripcion) ?></p>
                        <!-- Otros datos del objetivo si los hay -->
                        <!-- Contenido de la tarjeta -->
                        <div class="btn-group mt-3 mb-3" role="group" aria-label="Acciones adicionales">
                            <?= Html::button('Editar', ['id' => 'editar-btn', 'class' => 'btn btn-primary']) ?>
                             <!-- Enlace de eliminación modificado como un formulario oculto -->
                            <form id="form-eliminar" action="<?= Url::to(['delete', 'codobj' => $model->codobj]) ?>" method="post">
                                <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                                <?= Html::submitButton('Eliminar', ['class' => 'btn btn-danger', 'style' => 'display:none;']) ?>
                            </form>
                            <?= Html::button('Eliminar', ['class' => 'btn btn-danger', 'id' => 'eliminar-btn']) ?>
                             
                            <!-- Fin del formulario oculto -->
                            <?= Html::a('Continuar', ['objetivos/continuar'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
                <!-- Campos de edición -->
                <div id="editar-campos" style="display: none;">
                   <?php $form = ActiveForm::begin(['action' => ['update', 'codobj' => $model->codobj]]); ?>
                    <?= $form->field($model, 'denominacion')->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Ingrese el título de la entrada aquí', 'maxlength' => 100]) ?>
                    <?= $form->field($model, 'fechalimite')->textInput(['type' => 'date', 'class' => 'form-control', 'placeholder' => 'Seleccione la fecha límite','max' => '2100-12-31']) ?>
                    <?= $form->field($model, 'descripcion')->textarea(['rows' => 5, 'class' => 'form-control', 'placeholder' => 'Ingrese la descripción aquí', 'maxlength' => 500]) ?>

                    <!-- Botón de guardar -->
                    <div class="form-group">
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
                    </div>

                    <!-- Fin del formulario oculto -->
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <!-- Columna para la imagen -->
            <div class="col-md-6">
                <img src="<?= Url::to('@web/images/1.png') ?>" alt="Imagen de rama" class="imagen-formulario">
            </div>
        </div>
    </div>
</div>



<!-- Script JavaScript -->
<?php
$js = <<< JS
$(document).ready(function(){
    $('#eliminar-btn').on('click', function(e) {
        e.preventDefault(); // Evita que el enlace funcione normalmente
        $('#popup-confirmacion').fadeIn(); // Mostrar el popup de confirmación
    });

    $('#confirmar-eliminar').on('click', function() {
        $('#popup-confirmacion').fadeOut(); // Ocultar el popup de confirmación
        $('#form-eliminar').submit(); // Enviar el formulario de eliminación
    });

    $('#cancelar-eliminar').on('click', function() {
        $('#popup-confirmacion').fadeOut(); // Ocultar el popup de confirmación
    });
});
JS;
$this->registerJs($js);
?>

