<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor; // Importar la clase CKEditor

/* @var $this yii\web\View */
/* @var $model app\models\Entradas */

$this->registerCssFile(Url::to('@web/css/formulario.css'));
$this->title = $model->identrada;
$this->params['breadcrumbs'][] = ['label' => 'Entradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);

// Registro de script JS para el popup de confirmación y el formulario de edición
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

    // Mostrar u ocultar el formulario de edición al hacer clic en el botón "Editar"
    $('#editar-btn').click(function() {
        $('#editar-form').slideToggle(function() {
            if ($(this).is(':visible')) {
                // Inicializar CKEditor solo si aún no está inicializado
                if (!CKEDITOR.instances['entradas-descripcion']) {
                    CKEDITOR.replace('entradas-descripcion', {
                        preset: 'standard',
                        inline: false,
                        placeholder: 'Ingrese la descripción aquí (máximo 1500 caracteres)'
                    });
                }
            } else {
                // Destruir CKEditor si el formulario se oculta
                if (CKEDITOR.instances['entradas-descripcion']) {
                    CKEDITOR.instances['entradas-descripcion'].destroy();
                }
            }
        });
    });

    // Obtener el texto de la descripción
    var descripcion = $('#descripcion-texto').html();
    // Verificar si el texto supera los 500 caracteres
    if (descripcion.length > 500) {
        // Recortar el texto a 500 caracteres
        var descripcionCorta = descripcion.substring(0, 500);
        // Ocultar el texto original y mostrar el recortado
        $('#descripcion-texto').html(descripcionCorta + '...');
        // Mostrar el botón "Ver más"
        $('#ver-mas-btn').show();
    }
    // Manejar el clic en el botón "Ver más"
    $('#ver-mas-btn').click(function() {
        // Mostrar el texto completo
        $('#descripcion-texto').html(descripcion);
        // Ocultar el botón "Ver más"
        $(this).hide();
        // Mostrar el botón "Ver menos"
        $('#ver-menos-btn').show();
    });

    // Manejar el clic en el botón "Ver menos"
    $('#ver-menos-btn').click(function() {
        // Recortar el texto a 500 caracteres
        var descripcionCorta = descripcion.substring(0, 500);
        // Mostrar el texto recortado
        $('#descripcion-texto').html(descripcionCorta + '...');
        // Ocultar el botón "Ver menos"
        $(this).hide();
        // Mostrar el botón "Ver más"
        $('#ver-mas-btn').show();
    });
});
JS;
$this->registerJs($js);
?>

<!-- Popup de confirmación -->
<div id="popup-confirmacion" class="popup">
    <div class="popup-tarjeta">
        <div class="popup-contenido">
            <p>¿Estás seguro de que deseas eliminar esta entrada?</p>
            <div class="opciones">
                <button id="confirmar-eliminar" class="btn-continuar">Sí</button>
                <button id="cancelar-eliminar" class="btn-cancelar">No</button>
            </div>
        </div>
    </div>
</div>

<!-- Vista de Entradas -->
<div class="entradas-view">
    <div class="container">
        <div class="row">
            <!-- Columna principal para la tarjeta -->
            <div class="col-md-6">
                <div class="titulo-vista">
                    <h2 class="texto-vistaentrada">¿Deseas hacer algún cambio?</h2>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title"><?= Html::encode($model->titulo) ?></h2>
                        <p class="card-data">Fecha de entrada: <?= Yii::$app->formatter->asDate($model->fechaentrada, 'php:d-m-Y') ?></p>
                        <!-- Añade un div con un id específico para el texto de la descripción -->
                        <div id="descripcion-texto" class="card-data"><?= Html::decode($model->descripcion) ?></div>
                        <!-- Agrega botones para mostrar más y menos -->
                        <button id="ver-mas-btn" class="btn btn-primary" style="display: none;">Ver más</button>
                        <button id="ver-menos-btn" class="btn btn-primary" style="display: none;">Ver menos</button>
                        <!-- Contenido de la tarjeta -->
                        <div class="btn-group mt-3 mb-3" role="group" aria-label="Acciones adicionales">
                            <?= Html::a('Editar', '#', ['class' => 'btn btn-primary', 'id' => 'editar-btn']) ?>
                            <!-- Enlace de eliminación modificado como un formulario oculto -->
                            <form id="form-eliminar" action="<?= Url::to(['delete', 'identrada' => $model->identrada]) ?>" method="post">
                                <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                                <?= Html::submitButton('Eliminar', ['class' => 'btn btn-danger', 'style' => 'display:none;']) ?>
                            </form>
                            <?= Html::button('Eliminar', ['class' => 'btn btn-danger', 'id' => 'eliminar-btn']) ?>
                            <?= Html::a('Continuar', ['continuar', 'identrada' => $model->identrada], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
                <!-- Columna para el formulario de edición -->
                <div id="editar-form" style="display: none;">
                    <?php $form = ActiveForm::begin(['action' => ['update', 'identrada' => $model->identrada]]); ?>
                        <?= $form->field($model, 'titulo')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese un título (máx. 100 caracteres)','maxlength' => 100]) ?>
                        <!-- Utiliza CKEditor para la descripción -->
                        <?= $form->field($model, 'descripcion')->widget(CKEditor::class, [
                            'editorOptions' => [
                                'preset' => 'standard',
                                'inline' => false,
                                'placeholder' => 'Ingrese la descripción aquí (máximo 1500 caracteres)'
                            ],
                        ]) ?>
                        <!-- Botón de guardar -->
                        <div class="form-group">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <!-- Columna para la imagen -->
            <div class="col-md-6">
                <div class="imagen-formulario">
                    <img src="<?= Url::to('@web/images/2.png') ?>" alt="Chica Escribiendo" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
