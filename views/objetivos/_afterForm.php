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
// Array con los textos correspondientes a cada imagen
$textos = [
    '1 objetivo',
    '5 objetivos',
    '10 objetivos',
    '12 objetivos',
    '15 objetivos'
];

// Desbloquear recompensas en base al número de objetivos completados
$recompensasDesbloqueadas = [
    1 => false,
    2 => false,
    3 => false,
    4 => false,
    5 => false
];

if ($numeroObjetivosCompletados >= 1) {
    $recompensasDesbloqueadas[1] = true;
}
if ($numeroObjetivosCompletados >= 5) {
    $recompensasDesbloqueadas[2] = true;
}
if ($numeroObjetivosCompletados >= 10) {
    $recompensasDesbloqueadas[3] = true;
}
if ($numeroObjetivosCompletados >= 12) {
    $recompensasDesbloqueadas[4] = true;
}
if ($numeroObjetivosCompletados >= 15) {
    $recompensasDesbloqueadas[5] = true;
}
?>

<div class="recompensas">
    <?php for ($i = 1; $i <= 5; $i++): ?>
        <?php
        // Determinar si la recompensa está desbloqueada
        $claseDesbloqueo = ($recompensasDesbloqueadas[$i]) ? 'desbloqueada' : 'bloqueada';
        ?>
        <div class="recompensa <?= $claseDesbloqueo; ?>">
            <?= Html::img('@web/images/recompensa/' . $i . 'obj.png', ['alt' => 'Recompensa ' . $i]); ?>
            <!-- Texto a mostrar al hacer hover -->
            <div class="texto-hover"><?= isset($textos[$i - 1]) ? $textos[$i - 1] : '' ?></div>
        </div>
    <?php endfor; ?>
</div>





<!-- Vista de Objetivos Próximos y Buscador -->
<div class="container-tablas">

    <div class="row">

        <!-- Columna del Buscador de Objetivos -->
        <div class="col-md-6 buscador-objetivos">
            <!-- Formulario de búsqueda -->
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

            <!-- Lista de objetivos encontrados -->
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
        <!-- Columna de Objetivos Próximos -->
        <div class="col-md-6 objetivos-proximos">
            <h3 class="titulo-proximos">Próximos Objetivos</h3>
            <ul class="list-group listado-proximos">
                <?php foreach ($proximoObjetivos as $objetivo): ?>
                    <li class="list-group-item item-proximo">
                        <h4 class="titulo-item"><?= Html::encode($objetivo->denominacion) ?></h4>
                        <p class="detalle-item"><strong>Fecha Límite:</strong> <?= Yii::$app->formatter->format($objetivo->fechalimite, 'date') ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>




