<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA; //para los logos de las redes sociales

rmrevin\yii\fontawesome\AssetBundle::register($this);
AppAsset::register($this);

$this->registerCss(<<<CSS
/* Estilos para la barra de desplazamiento */
/* Estilos para navegadores webkit (Chrome, Safari, etc.) */
::-webkit-scrollbar {
    width: 7px; /* Ancho de la barra de desplazamiento */
}

::-webkit-scrollbar-thumb {
    background-color: #B65598; /* Color del botón de la barra de desplazamiento */
    border-radius: 5px; /* Radio del borde del botón */
}

/* Efecto de sombra para el navbar */
.navbar {
    box-shadow: 0 4px 6px rgba(119, 41, 183, 0.1); /* Cambia el color de la sombra aquí */
}

CSS
);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    
    <!-- nombres -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Marta Tirador Gutiérrez">
    <meta name="description" content="Aplicación para la gestión de emociones">
    <meta name="keywords" content="HTML, CSS, JavaScript, React">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title>Ikigai | Transforma tu vida</title>
    <?php $this->head() ?>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= Url::to('@web/logo.ico') ?>" />
    <link rel="icon" type="image/x-icon" href="<?= Url::to('@web/logo.ico') ?>"/>

</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>
<header>
    <?php
    NavBar::begin([
        'brandLabel' => '<div class="d-flex align-items-center">' . 
                        Html::img('@web/images/morado.png', ['alt'=>Yii::$app->name]) .
                        '</div>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav mr-auto custom-margin-left'], // Alineación a la izquierda
        'items' => [
            ['label' => 'INICIO', 'url' => Yii::$app->homeUrl], // Añadido el enlace de Inicio
            ['label' => '¿QUÉ ES IKIGAI?', 'url' => ['/site/informacion']],
            ['label' => 'OBJETIVOS', 'url' => ['/objetivos/continuar']],
            ['label' => 'DIARIO', 'url' => ['/entradas/diario']],
            ['label' => 'SOBRE MÍ', 'url' => ['/site/sobremi']],
            /*[
                'label' => 'CRUDs',
                'items' => [
                    ['label' => 'Entradas', 'url' => ['/entradas/index']],
                    ['label' => 'Pensamientos', 'url' => ['/pensamientos/index']],
                    ['label' => 'Emociones', 'url' => ['/emociones/index']],
                    ['label' => 'Sensaciones', 'url' => ['/sensaciones/index']],
                    ['label' => 'Objetivos', 'url' => ['/objetivos/index']],
                    ['label' => 'Registro de Pensamientos', 'url' => ['/registropensamientos/index']],
                    ['label' => 'Registro de Emociones', 'url' => ['/registroemociones/index']],
                    ['label' => 'Registro de Sensaciones', 'url' => ['/registrosensaciones/index']],
                    ['label' => 'Tipos de emociones', 'url' => ['/tiposemociones/index']],
                ],
            ],*/
        ],
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
    
<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy;Ikigai_MTG_<?= date('Y') ?></p> 
        <div class="social-icons" style="display: flex; justify-content: flex-end;">
            <?= Html::a(FA::icon('facebook')->size(FA::SIZE_2X), 'https://www.facebook.com', ['class' => 'profile-link', 'target' => '_blank']) ?>
            <?= Html::a(FA::icon('instagram')->size(FA::SIZE_2X), 'https://www.instagram.com', ['class' => 'profile-link', 'target' => '_blank']) ?>
            <?= Html::a(FA::icon('github')->size(FA::SIZE_2X), 'https://github.com/mtirador', ['class' => 'profile-link', 'target' => '_blank']) ?>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
    
<script src="<?= Url::to('@web/js/respuesta.js')?>"></script> <!-- Si o no (Cruds) -->
</body>
</html>
<?php $this->endPage() ?>
