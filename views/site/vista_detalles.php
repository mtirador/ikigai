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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<div class="detalles_titulo">
    <h1 class="titdet">Detalles de la Entrada</h1>
</div>

<div class="entry-details2">
    <div class="tarjeta_detalles animate__animated animate__fadeInLeft">
        <div class="card-header">
            <h3>Descripción de la Entrada</h3>
        </div>
        <div class="scrollable-body">
            <div class="card-body">        
                <p><strong>Título: </strong><?= Html::encode($entrada->titulo) ?></p>
                <div id="descripcion-texto" class="descripcion"><strong>Descripción: </strong><?= Html::decode($entrada->descripcion) ?></div>
            </div>
        </div>
    </div>
</div>

<div class="entry-details">
    <div class="tarjeta_detalles animate__animated animate__fadeInLeft">
        <div class="card-header">
            <h3>Pensamientos:</h3>
        </div>
        <div class="scrollable-body">
            <div class="card-body">
                <?php foreach ($pensamientos as $pensamiento): ?>
                    <?= Html::encode($pensamiento->texto) ?>
                    <p><?php echo ($pensamiento->intrusivo) ? '<strong>Intrusivo: </strong>Si' : '<strong>Intrusivo:</strong> No'; ?></p>
                    <p><?php echo ($pensamiento->recurrente) ? '<strong>Recurrente:</strong> Si' : '<strong>Recurrente:</strong> No'; ?></p>
                    <p><?php echo ($pensamiento->positivo) ? '<strong>Positivo:</strong> Si' : '<strong>Positivo:</strong> No'; ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="tarjeta_detalles animate__animated animate__fadeInLeft">
        <div class="card-header">
            <h3>Emociones:</h3>
        </div>
        <div class="scrollable-body">
            <div class="card-body">
                <?php foreach ($emociones as $emocion): ?>
                    <p><strong>Intensidad:</strong> <?= Html::encode($emocion->intensidad) ?></p>
                    <p><?= Html::encode($emocion->texto) ?></p>
                    <p><?php echo ($emocion->agradable) ? '<strong>Agradable:</strong> Si' : '<strong>Agradable:</strong> No'; ?></p>
                    <p><strong>Tipos de Emociones: </strong>
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
                    </p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="tarjeta_detalles animate__animated animate__fadeInLeft">
        <div class="card-header">
            <h3>Sensaciones:</h3>
        </div>
        <div class="scrollable-body">
            <div class="card-body">
                <?php foreach ($sensaciones as $sensacion): ?>
                    <div class="sensacion">
                        <?php
                        $descripcion = Html::encode($sensacion->descripcion);
                        $denominacion = Html::encode($sensacion->denominacion);
                        $localizacioncorporal = Html::encode($sensacion->localizacioncorporal);

                        $descripcionCorta = mb_strimwidth($descripcion, 0, 30, '...');
                        $denominacionCorta = mb_strimwidth($denominacion, 0, 30, '...');
                        $localizacionCorta = mb_strimwidth($localizacioncorporal, 0, 30, '...');
                        ?>

    
                        <p>
                            <strong>Descripción:</strong> 
                            <span class="short-description"><?= $descripcionCorta ?></span>
                            <span class="full-description" style="display: none;"><?= $descripcion ?></span>
                            <?php if (strlen($descripcion) > 30): ?>
                                <a href="#" class="toggle-description">Ver más</a>
                            <?php endif; ?>
                        </p>
        
                        <p>
                            <strong>Denominación:</strong> 
                            <span class="short-description"><?= $denominacionCorta ?></span>
                            <span class="full-description" style="display: none;"><?= $denominacion ?></span>
                            <?php if (strlen($denominacion) > 30): ?>
                                <a href="#" class="toggle-description">Ver más</a>
                            <?php endif; ?>
                        </p>
          
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


<div class="boton-regresar-container">

    <?= Html::a('Regresar', Yii::$app->request->referrer, ['class' => 'btn btn-regresar']) ?>

    <?= Html::a('Descargar PDF', ['site/download-pdf', 'id' => $entrada->identrada], ['class' => 'btn btn-descargar', 'target' => '_blank']) ?>
</div>
