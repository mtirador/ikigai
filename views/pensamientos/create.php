<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pensamientos $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerCssFile(Yii::$app->request->baseUrl . '/css/createPensamientos.css');

$this->title = '¿Cómo han sido tus pensamientos?';
$this->params['breadcrumbs'][] = ['label' => 'Pensamientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::hiddenInput('identrada', $identrada) ?>
<?= Html::hiddenInput('codpen', $model->codpen) ?>

<div class="pensamientos-create">
    <h1 class="text-center mb-4"><?= Html::encode($this->title) ?></h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="explanation-card">
                <div class="tarjeta-explicacion">
                    <h3 class="card-title">Importancia de registrar pensamientos</h3>
                    <p class="card-text">Identificar como son tus pensamientos te permite explorar tu mundo interior, entender tus emociones y avanzar en tu desarrollo personal</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card custom-card">
                <div class="card-body">
         
                    <?php $form = ActiveForm::begin(); ?>
                    <h3 class="titulo-pensamientos">Haz click en caso de afirmación</h3>
                
                    <?= $form->field($model, 'identrada')->hiddenInput(['value' => $identrada])->label(false) ?>

                    <?= $form->field($model, 'intrusivo')->checkbox(['label' => '¿Tuviste pensamientos intrusivos?', 'class' => 'custom-checkbox']) ?>

                    <?= $form->field($model, 'recurrente')->checkbox(['label' => '¿Tuviste pensamientos recurrentes?', 'class' => 'custom-checkbox']) ?>

                    <?= $form->field($model, 'positivo')->checkbox(['label' => '¿Tuviste pensamientos positivos?', 'class' => 'custom-checkbox']) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Continuar', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
