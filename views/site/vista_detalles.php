<?php

// Se incluyen los helpers de Yii para trabajar con HTML y URLs
use yii\helpers\Html;
use yii\helpers\Url;

// Registro de archivos CSS específicos para esta vista
$this->registerCssFile(Url::to('@web/css/entradasDiario.css'));
$this->registerCssFile(Url::to('@web/css/vistaDetalles.css'));

// Registro de archivo JS específico para esta vista, ubicado al final de la página
$this->registerJsFile(Url::to('@web/js/entryDetails.js'), ['position' => \yii\web\View::POS_END]);

?>

<!-- Inclusión de la biblioteca de animaciones animate.css desde un CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Contenedor del título de los detalles de la entrada -->
<div class="detalles_titulo">
    <h1 class="titdet">Detalles de la Entrada</h1>
</div>

<!-- Contenedor de la tarjeta de detalles de la entrada -->
<div class="entry-details2">
    <div class="tarjeta_detalles animate__animated animate__fadeInLeft">
        <div class="card-header">
            <h3>Descripción de la Entrada</h3>
        </div>
        <div class="scrollable-body">
            <div class="card-body">
                <!-- Mostrar el título de la entrada, codificado para evitar inyecciones -->
                <p><strong>Título: </strong><?= Html::encode($entrada->titulo) ?></p>
                <!-- Mostrar la descripción de la entrada, decodificada -->
                <div id="descripcion-texto" class="descripcion"><strong>Descripción: </strong><?= Html::decode($entrada->descripcion) ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Contenedor de los detalles adicionales de la entrada -->
<div class="entry-details">
    <!-- Tarjeta para los pensamientos asociados con la entrada -->
    <div class="tarjeta_detalles animate__animated animate__fadeInLeft">
        <div class="card-header">
            <h3>Pensamientos:</h3>
        </div>
        <div class="scrollable-body">
            <div class="card-body">
                <!-- Iterar sobre cada pensamiento y mostrar sus detalles -->
                <?php foreach ($pensamientos as $pensamiento): ?>
                    <?= Html::encode($pensamiento->texto) ?>
                    <p><?php echo ($pensamiento->intrusivo) ? '<strong>Intrusivo: </strong>Si' : '<strong>Intrusivo:</strong> No'; ?></p>
                    <p><?php echo ($pensamiento->recurrente) ? '<strong>Recurrente:</strong> Si' : '<strong>Recurrente:</strong> No'; ?></p>
                    <p><?php echo ($pensamiento->positivo) ? '<strong>Positivo:</strong> Si' : '<strong>Positivo:</strong> No'; ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Tarjeta para las emociones asociadas con la entrada -->
    <div class="tarjeta_detalles animate__animated animate__fadeInLeft">
        <div class="card-header">
            <h3>Emociones:</h3>
        </div>
        <div class="scrollable-body">
            <div class="card-body">
                <!-- Iterar sobre cada emoción y mostrar sus detalles -->
                <?php foreach ($emociones as $emocion): ?>
                    <p><strong>Intensidad:</strong> <?= Html::encode($emocion->intensidad) ?></p>
                    <p><?= Html::encode($emocion->texto) ?></p>
                    <p><?php echo ($emocion->agradable) ? '<strong>Agradable:</strong> Si' : '<strong>Agradable:</strong> No'; ?></p>
                    <p><strong>Tipos de Emociones: </strong>
                        <?php
                        // Obtener y mostrar los tipos de emociones
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
                    </p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Tarjeta para las sensaciones asociadas con la entrada -->
    <div class="tarjeta_detalles animate__animated animate__fadeInLeft">
        <div class="card-header">
            <h3>Sensaciones:</h3>
        </div>
        <div class="scrollable-body">
            <div class="card-body">
                <!-- Iterar sobre cada sensación y mostrar sus detalles -->
                <?php foreach ($sensaciones as $sensacion): ?>
                    <div class="sensacion">
                        <?php
                        // Codificar las descripciones para evitar inyecciones
                        $descripcion = Html::encode($sensacion->descripcion);
                        $denominacion = Html::encode($sensacion->denominacion);
                        $localizacioncorporal = Html::encode($sensacion->localizacioncorporal);
                        // Recortar las descripciones largas
                        $descripcionCorta = mb_strimwidth($descripcion, 0, 30, '...');
                        $denominacionCorta = mb_strimwidth($denominacion, 0, 30, '...');
                        $localizacionCorta = mb_strimwidth($localizacioncorporal, 0, 30, '...');
                        ?>

                        <!-- Mostrar descripción de la sensación -->
                        <p>
                            <strong>Descripción:</strong> 
                            <span class="short-description"><?= $descripcionCorta ?></span>
                            <span class="full-description" style="display: none;"><?= $descripcion ?></span>
                            <?php if (strlen($descripcion) > 30): ?>
                                <a href="#" class="toggle-description">Ver más</a>
                            <?php endif; ?>
                        </p>
                        <!-- Mostrar denominación de la sensación -->
                        <p>
                            <strong>Denominación:</strong> 
                            <span class="short-description"><?= $denominacionCorta ?></span>
                            <span class="full-description" style="display: none;"><?= $denominacion ?></span>
                            <?php if (strlen($denominacion) > 30): ?>
                                <a href="#" class="toggle-description">Ver más</a>
                            <?php endif; ?>
                        </p>
                        <!-- Mostrar localización corporal de la sensación -->
                        <p>
                            <strong>Localización Corporal:</strong> 
                            <span class="short-description"><?= $localizacionCorta ?></span>
                            <span class="full-description" style="display: none;"><?= $localizacioncorporal ?></span>
                            <?php if (strlen($localizacioncorporal) > 30): ?>
                                <a href="#" class="toggle-description">Ver más</a>
                            <?php endif; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Contenedor para los botones "Regresar" y "Descargar PDF" -->
<div class="boton-regresar-container">
    <!-- Botón para regresar a la página anterior -->
    <?= Html::a('Regresar', Yii::$app->request->referrer, ['class' => 'btn btn-regresar']) ?>
    <!-- Botón para descargar un PDF de la entrada -->
    <?= Html::a('Descargar PDF', ['site/download-pdf', 'id' => $entrada->identrada], ['class' => 'btn btn-descargar', 'target' => '_blank']) ?>
</div>
