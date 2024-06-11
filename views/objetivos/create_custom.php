<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Objetivos */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile(Url::to('@web/css/formulario.css'));
$this->registerJsFile('@web/js/confirmation.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
$this->title = 'Crear Nuevo Objetivo';
$this->params['breadcrumbs'][] = ['label' => 'Objetivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div id="popup-confirmacion" class="popup">
    <div class="popup-tarjeta">
        <div class="popup-contenido">
            <p>¿Desea continuar?</p>
            <div class="opciones">
                <button id="confirmar-guardar" class="btn-continuar">Continuar</button>
                <button id="cancelar-guardar" class="btn-cancelar">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="objetivos-create">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">¡Haz que suceda!</h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'denominacion')->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Ingrese el título de la entrada aquí(máximo 100 caracteres)']) ?>

                    <?=
                    $form->field($model, 'fechalimite')->textInput([
                        'type' => 'date',
                        'class' => 'form-control',
                        'placeholder' => 'Seleccione la fecha límite',
                        'min' => date('Y-m-d'), // Establece la fecha mínima como la fecha actual
                        'max' => '2100-12-31' // Establece la fecha máxima como el 31 de diciembre de 2100
                    ])
                    ?>


                    <?=
                    $form->field($model, 'descripcion')->textarea([
                        'rows' => 5,
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese la descripción aquí (máximo 500 caracteres)',
                        'maxlength' => 500 //Establece la longitud máxima del campo a 100 caracteres
                    ])->label('Descripción')
                    ?>


                    <div class="form-group">
<?= Html::submitButton('Guardar', ['id' => 'guardar-btn', 'class' => 'btn btn-success']) ?>
                    </div>

<?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <img src="<?= Url::to('@web/images/mujerflores.png') ?>" alt="Chica con flores" class="imagen-formulario">
        </div>
    </div>
</div>

<?php
// Incluye el archivo JavaScript de confirmación
$this->registerJsFile('@web/js/confirmation.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

