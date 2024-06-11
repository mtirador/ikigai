<?php
/** @var yii\web\View $this */
$this->title = 'My Yii Application';

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->registerCssFile(Url::to('@web/css/entradasDiario.css'));
$this->registerCssFile(Url::to('@web/css/modalHome.css'));

/* Archivos Js */
$this->registerJsFile(Url::to('@web/js/scrollVisibilidad.js'), ['position' => View::POS_END]);
$this->registerJsFile(Url::to('@web/js/heartBeat.js'));
$this->registerJsFile(Url::to('@web/js/modalHandling.js'), ['position' => View::POS_END]);
?>

<body>
    <div class="tituloHome">
        <div class="background-image">
            <h1 id="pageTitle" class="animated-title">IKIGAI</h1>
            <hr class="linea-larga">
            <p class="subtitulo">"Tu propósito de vida"</p>
        </div>
    </div>

    <div class="contenedor">
        <div class="tarjeta-boton entry">
            <a href="#" id="create-entry-link" data-check-url="<?= Url::to(['entradas/check-and-create']) ?>" data-create-url="<?= Url::to(['entradas/create']) ?>">
                <div class="card-inner heartbeat-animation">
                    <img src="./images/d2.png" alt="Imagen 1">
                    <div class="overlay">
                        <h3>Crear Entrada</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="tarjeta-boton entry">
            <a href="<?= Url::to(['objetivos/create-custom']) ?>">
                <div class="card-inner heartbeat-animation">
                    <img src="./images/obje.png" alt="Imagen 2">
                    <div class="overlay">
                        <h3>Establecer Objetivo</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="tarjeta-boton entry">
            <a href="<?= Url::to(['site/estadisticas']) ?>">
                <div class="card-inner heartbeat-animation">
                    <img src="./images/esta.png" alt="Imagen 3">
                    <div class="overlay">
                        <h3>Estadísticas</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Entradas diario -->
    <div class="site-index">
        <div class="jumbotron entry">
            <h2 class="titulo-entradas">Últimas Entradas de Diario</h2>
        </div>

        <div class="body-content">
            <div class="row">
<?php foreach ($entradas as $entrada): ?>
                    <div class="col-lg-4 entry">
                        <div class="card-container mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="title"><?= Html::encode($entrada->titulo) ?></h3>
                                </div>
                                <div class="card-body">
                                    <p><strong>Fecha :</strong> <?= Yii::$app->formatter->asDate($entrada->fechaentrada) ?></p>
                                    <div class="description"><?= Html::decode($entrada->descripcion) ?></div>
    <?= Html::a('Ver detalles', ['site/view', 'id' => $entrada->identrada], ['class' => 'btn btn-primary']) ?>
                                </div>
                            </div>
                        </div>
                    </div>

<?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="entryExistsModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p class="modal-p">Ya existe una entrada para el día de hoy. No puedes crear una nueva.</p>
            <button id="cancel-btn">Cancelar</button>
        </div>
    </div>
</body>
