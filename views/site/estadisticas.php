<?php

use dosamigos\highcharts\HighCharts; // Importa la clase HighCharts
use yii\helpers\Html;

$this->registerCssFile('@web/css/estadisticas.css');

$this->title = 'Estadísticas de Pensamientos';
?>

<div class="container-fluid estadisticas-container">

    <h2 class="text-center mb-4 titulo-principal">Información sobre tu progreso</h2>

    <div class="row">
        <div class="col-md-4 d-flex align-items-center justify-content-center">
  
            <div class="datos-container">
                <h2 class="text-center">Datos Numéricos</h2>
                <div class="content">
                    <p class="upper-line">Pensamientos Positivos: <?= $positivas ?></p>
                    <p class="lower-line">Pensamientos Negativos: <?= $negativas ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-8"> 
           
            <div class="grafico-container">
                <?php
               
                $data = [
                    ['name' => 'Pensamientos Positivos', 'y' => $positivas],
                    ['name' => 'Pensamientos Negativos', 'y' => $negativas],
                ];

                echo HighCharts::widget([
                    'clientOptions' => [
                        'chart' => [
                            'type' => 'pie', 
                            'backgroundColor' => 'rgba(0, 0, 0, 0)', 
                        ],
                        'title' => ['text' => null], 
                        'plotOptions' => [
                            'pie' => [
                                'dataLabels' => [
                                    'enabled' => true,
                                    'style' => [
                                        'color' => '#B65598', 
                                        'fontFamily' => '"Open Sans", Roboto, Lato, Montserrat, Nunito, "Source Sans Pro", "PT Sans", sans-serif',
                                    ],
                                ],
                            ],
                        ],
                        'series' => [
                            [
                                'name' => 'Cantidad',
                                'data' => $data,
                                'dataLabels' => [
                                    'enabled' => true,
                                    'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
                                ],
                                'colors' => ['#B65598', '#e6d7f6'], 
                            ],
                        ],
                        'credits' => ['enabled' => false], 
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid estadisticas-container">
    <div class="row">
        <div class="col-md-12">
            <div class="grafico-container">

                <?php
           
                $objetivosData = $this->context->actionObjetivos();

          
                $coloresObjetivos = ['#B65598', '#e6d7f6']; 
            
                $dataObjetivos = [
                    ['name' => 'Completados', 'y' => $objetivosData['completados'], 'color' => $coloresObjetivos[0]],
                    ['name' => 'No Completados', 'y' => $objetivosData['noCompletados'], 'color' => $coloresObjetivos[1]],
                ];

             
                echo HighCharts::widget([
                    'clientOptions' => [
                        'chart' => [
                            'type' => 'bar', 
                            'backgroundColor' => 'rgba(0, 0, 0, 0)', 
                        ],
                        'title' => [
                            'text' => 'Objetivos Completados vs No Completados',
                            'style' => [
                                'color' => '#B65598',
                            ],
                        ],
                        'plotOptions' => [
                            'bar' => [
                                'dataLabels' => [
                                    'enabled' => true,
                                    'style' => [
                                        'color' => '#B65598', 
                                        'fontFamily' => '"Open Sans", Roboto, Lato, Montserrat, Nunito, "Source Sans Pro", "PT Sans", sans-serif',
                                    ],
                                    'format' => '<b>{point.name}</b>: {point.y}',
                                ],
                            ],
                        ],
                        'series' => [
                            [
                                'name' => 'Objetivos',
                                'data' => $dataObjetivos,
                            ],
                        ],
                        'credits' => ['enabled' => false], 
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
