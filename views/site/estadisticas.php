<?php

use dosamigos\highcharts\HighCharts; // Importa la clase HighCharts
use yii\helpers\Html;

$this->registerCssFile('@web/css/estadisticas.css');

$this->title = 'Estadísticas de Pensamientos';
?>

<div class="container-fluid estadisticas-container">
    <!-- Título principal -->
    <h2 class="text-center mb-4 titulo-principal">Información sobre tu progreso</h2>

    <div class="row">
        <div class="col-md-4 d-flex align-items-center justify-content-center"> <!-- Ajusta el tamaño de la columna a 4 -->
            <!-- Datos Numéricos -->
            <div class="datos-container">
                <h2 class="text-center">Datos Numéricos</h2>
                <div class="content">
                    <p class="upper-line">Pensamientos Positivos: <?= $positivas ?></p>
                    <p class="lower-line">Pensamientos Negativos: <?= $negativas ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-8"> <!-- Ajusta el tamaño de la columna a 8 -->
            <!-- Gráfico de Pastel -->
            <div class="grafico-container">
                <?php
                // Define los datos para el gráfico
                $data = [
                    ['name' => 'Pensamientos Positivos', 'y' => $positivas],
                    ['name' => 'Pensamientos Negativos', 'y' => $negativas],
                ];

                // Renderiza el gráfico utilizando la extensión HighCharts
                echo HighCharts::widget([
                    'clientOptions' => [
                        'chart' => [
                            'type' => 'pie', // Tipo de gráfico de pastel
                            'backgroundColor' => 'rgba(0, 0, 0, 0)', // Fondo transparente
                        ],
                        'title' => ['text' => null], // Sin título
                        'plotOptions' => [
                            'pie' => [
                                'dataLabels' => [
                                    'enabled' => true,
                                    'style' => [
                                        'color' => '#B65598', // Color del texto
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
                                'colors' => ['#B65598', '#e6d7f6'], // Colores de los trozos de pastel (positivo y negativo)
                            ],
                        ],
                        'credits' => ['enabled' => false], // Desactivar los créditos de HighCharts
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
                // Obtener los datos del gráfico de objetivos utilizando actionGraficoObjetivos()
                $objetivosData = $this->context->actionObjetivos();

                // Definir los colores para el gráfico de objetivos
                $coloresObjetivos = ['#B65598', '#e6d7f6']; // Colores para los datos completados y no completados
                // Definir los datos para el gráfico de objetivos
                $dataObjetivos = [
                    ['name' => 'Completados', 'y' => $objetivosData['completados'], 'color' => $coloresObjetivos[0]],
                    ['name' => 'No Completados', 'y' => $objetivosData['noCompletados'], 'color' => $coloresObjetivos[1]],
                ];

                // Renderizar el gráfico utilizando la extensión HighCharts
                echo HighCharts::widget([
                    'clientOptions' => [
                        'chart' => [
                            'type' => 'bar', // Tipo de gráfico de barras
                            'backgroundColor' => 'rgba(0, 0, 0, 0)', // Fondo transparente
                        ],
                        'title' => [
                            'text' => 'Objetivos Completados vs No Completados',
                            'style' => [
                                'color' => '#B65598', // Color del texto del título
                            ],
                        ],
                        'plotOptions' => [
                            'bar' => [
                                'dataLabels' => [
                                    'enabled' => true,
                                    'style' => [
                                        'color' => '#B65598', // Color del texto
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
                        'credits' => ['enabled' => false], // Desactivar los créditos de HighCharts
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
