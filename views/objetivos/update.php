<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Objetivos $model */

$this->title = 'Editar Objetivo: ' . $model->denominacion;
$this->params['breadcrumbs'][] = ['label' => 'Objetivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->codobj, 'url' => ['view', 'codobj' => $model->codobj]];
$this->params['breadcrumbs'][] = 'Update';
$this->registerCssFile(Url::to('@web/css/formulario.css'));
?>
<div class="objetivos-update">

   <div class="row">
        <div class="col-md-12">
            <h1 class="text-justify"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <img src="<?= Url::to('@web/images/pajaro.png') ?>" alt="Meditacion" class="imagen-formulario">
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'denominacion')->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Ingrese el título de la entrada aquí']) ?>

                    <?= $form->field($model, 'fechalimite')->textInput(['type' => 'date', 'class' => 'form-control', 'placeholder' => 'Seleccione la fecha límite', 'min' => date('Y-m-d')])
                        ->hint('Elija la fecha en la que desea completar este objetivo. Esto ayudará a mantenerse enfocado en su progreso.');
                    ?>

                    <?= $form->field($model, 'descripcion')->textarea([
                        'rows' => 5, 
                        'class' => 'form-control', 
                        'placeholder' => 'Ingrese la descripción aquí', 
                        'maxlength' => 100 //Establece la longitud máxima del campo a 100 caracteres
                     ])->label('Descripción') ?>


                    <div class="form-group">
                        <?= Html::submitButton('Guardar', ['id' => 'guardar-btn', 'class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
