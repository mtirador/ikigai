<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->registerCssFile(Url::to('@web/css/entradasDiario.css'));

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Contenedor para el logo y el título -->
<div class="header-container">
    <div class="logo-container">
        <img src="<?= Url::to('@web/images/morado.png') ?>" alt="Logo de Ikigai" class="logo">
    </div>
    <div class="detalles_titulo">
        <h2>Ikigai | Transforma tu vida</h2>
    </div>
</div>

<div class="entry-details2">
    <div class="tarjeta_detalles animate__animated animate__fadeInLeft">
        <div class="card-header">
            <h3>Descripción de la Entrada</h3>
        </div>
        <div class="scrollable-body">
            <div class="card-body">
                <p><strong>Título: </strong><?= Html::encode($entrada->titulo) ?></p>
                <div id="descripcion-texto" class="descripcion">
                    <strong>Descripción: </strong><?= Html::decode($entrada->descripcion) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="entry-details">
    <h3>Pensamientos</h3>
    <ul>
        <?php foreach ($pensamientos as $pensamiento): ?>
            <li>
                <?= Html::encode($pensamiento->texto) ?>
                <ul>
                    <li><strong>Intrusivo:</strong> <?= Html::encode($pensamiento->intrusivo ? 'Sí' : 'No') ?></li>
                    <li><strong>Recurrente:</strong> <?= Html::encode($pensamiento->recurrente ? 'Sí' : 'No') ?></li>
                    <li><strong>Positivo:</strong> <?= Html::encode($pensamiento->positivo ? 'Sí' : 'No') ?></li>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <h3>Emociones</h3>
    <ul>
        <?php foreach ($emociones as $emocion): ?>
            <li>
                <ul>
                    <li><strong>Intensidad:</strong> <?= Html::encode($emocion->intensidad) ?></li>
                    <li><?= Html::encode($emocion->texto) ?></li>
                    <li><strong>Agradable:</strong> <?= Html::encode($emocion->agradable ? 'Sí' : 'No') ?></li>
                    <li><strong>Tipos de Emociones:</strong> 
                        <?php 
                            $tiposEmociones = $emocion->getTiposemociones()->all(); 
                            $tiposEmocionesString = '';
                            foreach ($tiposEmociones as $index => $tipoEmocion) {
                                $tiposEmocionesString .= Html::encode($tipoEmocion->tipos);
                                if ($index < count($tiposEmociones) - 1) {
                                    $tiposEmocionesString .= ', ';
                                }
                            }
                            echo $tiposEmocionesString;
                        ?>
                    </li>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <h3>Sensaciones</h3>
    <ul>
        <?php foreach ($sensaciones as $sensacion): ?>
            <li>
                <ul>
                    <li><strong>Descripción:</strong> <?= Html::encode($sensacion->descripcion) ?></li>
                    <li><strong>Denominación:</strong> <?= Html::encode($sensacion->denominacion) ?></li>
                    <li><strong>Localización Corporal:</strong> <?= Html::encode($sensacion->localizacioncorporal) ?></li>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
