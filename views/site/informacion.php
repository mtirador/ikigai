<?php
/** @var yii\web\View $this */
$this->title = 'My Yii Application';

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->registerJsFile('@web/js/informacion.js');
$this->registerCssFile(Url::to('@web/css/informacion.css'));
?>

<div class="texto-infor" style="margin-bottom: 20px;">          
    <h1>Descubre más sobre Ikigai</h1>
</div>

<ul class="tabs" style="margin-bottom: 20px;">
    <li class="active2" data-id="0">Diario</li>
    <li data-id="1">Kintsugi</li>
    <li data-id="2">Objetivos</li>
    <li data-id="3">Mindfulness</li>
</ul>

<div class="contents">
    <div class="box show" data-content="0">
        <img src="https://images.pexels.com/photos/1533469/pexels-photo-1533469.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
        <div>
            <h3>Diario</h3>
            <p>
                El journaling es una práctica que permite explorar pensamientos, emociones y experiencias. Ayuda a reflexionar, identificar patrones y encontrar claridad, actuando como una terapia personal que fomenta el autoconocimiento y crecimiento personal.
            </p>
        </div>
    </div>

    <div class="box hide" data-content="1">
        <img src="https://media.licdn.com/dms/image/D4D12AQEf5mC2hSvTYQ/article-cover_image-shrink_720_1280/0/1690997623160?e=2147483647&v=beta&t=xJ4tTSQYI_fXW_DCUcRKykhw8X7n9Pvup7rxEO7YxkY" alt="">
        <div>
            <h3>Kintsugi</h3>
            <p>
                Kintsugi es un arte japonés que repara objetos rotos con oro, celebrando cicatrices como parte de la historia. Enseña que las cicatrices emocionales deben ser aceptadas y transformadas en fortaleza y crecimiento.
            </p>
        </div>
    </div>

    <div class="box hide" data-content="2">
        <img src="https://images.pexels.com/photos/289586/pexels-photo-289586.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
        <div>
            <h3>Objetivos</h3>
            <p>
                Establecer objetivos da dirección y propósito a nuestras vidas, enfocando energía y atención en lo que importa. Nos inspiran a superar obstáculos y alcanzar el éxito, proporcionando satisfacción y crecimiento personal.
            </p>
        </div>
    </div>

    <div class="box hide" data-content="3">
        <img src="https://images.pexels.com/photos/1051838/pexels-photo-1051838.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
        <div>
            <h3>Mindfulness</h3>
            <p>
                Mindfulness nos invita a vivir el momento presente con atención plena y sin juicio, reduciendo el estrés y la ansiedad. Fomenta la calma, mejora la concentración y fortalece la conexión con nosotros mismos y con los demás.
            </p>
        </div>
    </div>
</div>

<div class="row d-flex">
    <!--  1 -->
    <div class="col-md-4 mb-4">
        <div class="card-container" id="ikigai-card">
            <div class="image-container">
<?= Html::img('@web/images/symbol.png', ['class' => 'imagen-transparente', 'alt' => 'Descripción de la imagen']) ?>
            </div>
            <div class="content-container">
                <h2>Significado de Ikigai</h2>
                <strong><p>Propósito de Vida:</strong> Según la cultura japonesa, todos tenemos un ikigai, un propósito de vida o una actividad que nos hace muy felices.</p>
                <strong><p>Camino de Autoconocimiento:</strong> Encontrar tu ikigai requiere un camino de emprendimiento y crecimiento personal constante.</p>
                <strong><p>Calidad de Vida:</strong> El autoconocimiento tenaz lleva al mejor de los premios: calidad de vida.</p>
            </div>
        </div>
    </div>
    <!-- 2 -->
    <div class="col-md-4 mb-4">
        <div class="card-container" id="Funcionalidad-card">
            <div class="image-container">
<?= Html::img('@web/images/brain.png', ['class' => 'imagen-transparente', 'alt' => 'Descripción de la imagen']) ?>
            </div>
            <div class="content-container">
                <h2>¿Para qué sirve nuestra aplicación?</h2>
                <strong><p>Comprender tus Emociones:</strong> Identifica tus emociones para un mayor autoconocimiento.</p>
                <strong><p>Gestionar el Estrés:</strong> Encuentra técnicas y consejos para manejar el estrés diario.</p>
                <strong><p>Descubrir tu Ikigai:</strong> Explora actividades que te apasionen y contribuyan a tu bienestar general.</p>
            </div>
        </div>
    </div>
    <!--  3 -->
    <div class="col-md-4 mb-4">
        <div class="card-container" id="Objetivos-card">
            <div class="image-container">
<?= Html::img('@web/images/crecimiento.png', ['class' => 'imagen-transparente', 'alt' => 'Descripción de la imagen']) ?>
            </div>
            <div class="content-container">
                <h2>Objetivos Personales</h2>
                <strong><p>Establecer Metas:</strong> Fundamental para visualizar lo que verdaderamente es importante en tu vida.</p>
                <strong><p>Superar Obstáculos:</strong> Requiere autodisciplina para superar los obstáculos que inevitablemente surgen en el camino.</p>
                <strong><p>Satisfacción Personal:</strong> Al lograr tus metas, experimentas un sentido de logro, fortaleciendo tu autoestima y confianza en ti mismo.</p>
            </div>                  
        </div>
    </div>
</div>
