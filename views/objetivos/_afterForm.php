<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Objetivos */

$this->registerCssFile(Url::to('@web/css/formulario.css'));
$this->title = $model->denominacion;
$this->params['breadcrumbs'][] = ['label' => 'Objetivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="titulo-search">
    <h1 class="texto-search">Explorador de Objetivos y Tareas</h1>
</div>




<?php
$texts = [
    '1 objetivo',
    '5 objetivos',
    '10 objetivos',
    '12 objetivos',
    '15 objetivos'
];

$rewardsUnlocked = [
    1 => false,
    2 => false,
    3 => false,
    4 => false,
    5 => false
];

if ($numberOfCompletedGoals >= 1) {
    $rewardsUnlocked[1] = true;
}
if ($numberOfCompletedGoals >= 5) {
    $rewardsUnlocked[2] = true;
}
if ($numberOfCompletedGoals >= 10) {
    $rewardsUnlocked[3] = true;
}
if ($numberOfCompletedGoals >= 12) {
    $rewardsUnlocked[4] = true;
}
if ($numberOfCompletedGoals >= 15) {
    $rewardsUnlocked[5] = true;
}
?>

<div class="recompensas">
    <?php for ($i = 1; $i <= 5; $i++): ?>
        <?php
        $classUnlocked = ($rewardsUnlocked[$i]) ? 'desbloqueada' : 'bloqueada';
        ?>
        <div class="recompensa <?= $classUnlocked; ?>">
            <?= Html::img('@web/images/recompensa/' . $i . 'obj.png', ['alt' => 'Recompensa ' . $i]); ?>
    
            <div class="texto-hover"><?= isset($texts[$i - 1]) ? $texts[$i - 1] : '' ?></div>
        </div>
    <?php endfor; ?>
</div>

<div class="container-tablas">

    <div class="row">

        <div class="col-md-6 buscador-objetivos">

            <form id="searchForm" action="<?= Url::to(['objetivos/buscar']) ?>" method="get">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text label-seleccion" for="completadoSelect">Objetivos</label>
                    </div>
                    <select class="custom-select seleccion-completado" id="completadoSelect" name="completado">
                        <option value="0" <?= Yii::$app->request->get('completado') === '0' ? 'selected' : '' ?>>No completados</option>
                        <option value="1" <?= Yii::$app->request->get('completado') === '1' ? 'selected' : '' ?>>Completados</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary boton-buscar" type="submit">Buscar</button>
                    </div>
                </div>
            </form>

            
            <div class="scrollable-list" id="objetivos-encontrados">
                <?php if (isset($searchResults) && !empty($searchResults)): ?>
                    <ul class="list-group listado-encontrados">
                        <?php foreach ($searchResults as $objetivo): ?>
                            <li class="item-encontrado">
                                <div class="objetivo-info">
                                    <h4 class="titulo-objetivo"><?= Html::encode($objetivo->denominacion) ?></h4>
                                    <p class="detalle-objetivo"><strong>Fecha Límite:</strong> <?= Yii::$app->formatter->format($objetivo->fechalimite, 'date') ?></p>
                                </div>
                                <div class="botones-objetivo">
                                    <?php if ($objetivo->completado): ?>
                                        <?= Html::a('Desmarcar', ['objetivos/desmarcar', 'codobj' => $objetivo->codobj], ['class' => 'btn btn-success']) ?>
                                    <?php else: ?>
                                        <?= Html::a('Marcar', ['objetivos/marcar', 'codobj' => $objetivo->codobj], ['class' => 'btn btn-success']) ?>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>


                    </ul>
                <?php else: ?>
                    <p class="no-objetivos">No se encontraron resultados.</p>
                <?php endif; ?>
            </div>



        </div>
      
        <div class="col-md-6 objetivos-proximos">
            <h3 class="titulo-proximos">Próximos Objetivos</h3>
            <ul class="list-group listado-proximos">
                <?php foreach ($nextGoals as $objetivo): ?>
                    <li class="list-group-item item-proximo">
                        <h4 class="titulo-item"><?= Html::encode($objetivo->denominacion) ?></h4>
                        <p class="detalle-item"><strong>Fecha Límite:</strong> <?= Yii::$app->formatter->format($objetivo->fechalimite, 'date') ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>




