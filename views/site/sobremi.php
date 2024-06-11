<?php

/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View; 
$this->title = 'Sobre Mi';

$this->registerCssFile('@web/css/sobremi.css');
$this->registerJsFile('@web/js/sobremi.js');

?>
<div class="area" style="position: fixed;background-color:#F5F2FF;">
  <ul class="circles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
  </ul>
</div>
<div class="wrapper">
  <div id="div-mask-front">
    <h1>¡Hola mundo!</h1>
    <p>Este apartado es sobre mí</p>
  </div>
  <div id="div-mask-back" aria-hidden="true">
    <div class="area" style="position: absolute;background-color: #e6d7f6;">
      <ul class="circles">
        <li style="--color: linear-gradient(319deg, #F5F2FF 0%, #B65598 37%, #ff9999 100%);"></li>
        <li style="--color: linear-gradient(315deg, #F5F2FF 0%, #B65598 74%);"></li>
        <li style="--color: linear-gradient(315deg, #F5F2FF 0%, #B65598 74%);"></li>
        <li style="--color: linear-gradient(315deg, #F5F2FF 0%, #B65598 74%);"></li>
        <li style="--color: linear-gradient(319deg, #F5F2FF 0%, #B65598 37%, #1cfdd6 100%);"></li>
        <li style="--color: linear-gradient(315deg, #B65598 0%, #B65598 74%);"></li>
        <li style="--color: linear-gradient(319deg, #F5F2FF 0%, #B65598 37%, #efc2cf 100%);"></li>
        <li style="--color: linear-gradient(319deg, #B65598 0%, #B65598 37%, #ffcfd2 100%);"></li>
        <li style="--color: linear-gradient(315deg, #F5F2FF 0%, #F5F2FF 74%);"></li>
        <li style="--color: linear-gradient(315deg, #F5F2FF 0%, #B65598 74%);"></li>
      </ul>
    </div>
    <pre>
<span class="variable">Nombre</span> <span class="character">=</span> <span class="string">"Marta Tirador"</span>
<span class="variable">Profesión</span> <span class="character">=</span> <span class="string">"Desarrolladora Junior"</span>
<span class="variable">Experiencia</span> <span class="character">=</span> <span class="string">"Desarrollo de aplicaciones multiplataforma"</span>

<span class="variable">Habilidades</span> <span class="character">=</span> <span class="bracket">{</span>
    <span class="string">"Desarrollo Frontend"</span> <span class="character">:</span> <span class="string">"HTML/CSS | Node/JS | Astro..."</span><span class="character">,</span>
    <span class="string">"Desarrollo Backend"</span> <span class="character">:</span> <span class="string">"Java | C# |"</span><span class="character">,</span>
    <span class="string">"Desarrollo de Juegos"</span> <span class="character">:</span> <span class="string">"Unity | C# |"</span><span class="character">,</span>
    <span class="string">"Prototipado"</span> <span class="character">:</span> <span class="string">"Figma |"</span><span class="character">,</span>
    <span class="string">"Otros"</span> <span class="character">:</span> <span class="string">"Git/Github/GitLab |"</span>
<span class="bracket">}</span>

<span class="variable">Hobbies</span> <span class="character">=</span> <span class="bracket">[</span>
    <span class="string">"Aprender nuevas tecnologias"</span><span class="character">,</span>
    <span class="string">"Pilates y meditación"</span><span class="character">,</span>
    <span class="string">"Leer muchos muchos libros :)"</span><span class="character">,</span>
    <span class="string">"Disfrutar de la gastronomía"</span><span class="character">,</span>
    <span class="string">"Deporte"</span>
<span class="bracket">]</span>
            </pre>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>