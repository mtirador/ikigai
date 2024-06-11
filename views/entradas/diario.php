<?php
use app\models\Entradas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View; 

/* @var $this yii\web\View */

$this->title = 'Diario';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/diario.css');

// Obtener todas las entradas
$entradas = Entradas::find()->all();
$fechasYTitulos = [];
foreach ($entradas as $entrada) {
    $fechasYTitulos[] = [
        'fecha' => date('Y-m-d', strtotime($entrada->fechaentrada)),
        'titulo' => $entrada->titulo,
        'descripcion' => $entrada->descripcion // Se añade la descripción
    ];
}
?>

<div class="site-diario">
    <div class="pagina-diario">
        <h1 class="titulo-diario">Diario</h1>
    </div>

    <div class="calendar-container">
        <div id="calendar"></div>
    </div>
</div>

<!-- Modal para mostrar detalles de la entrada -->
<div class="modal fade" id="entradaModal" tabindex="-1" role="dialog" aria-labelledby="entradaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="entradaModalLabel">Detalles de la entrada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Contenido de los detalles de la entrada -->
                <div id="entradaDetalle"></div>
            </div>
            <div class="modal-footer">
                <?= Html::button('Ver Detalles', [
                    'class' => 'btn btn-primary',
                    'id' => 'verDetallesBtn', // ID del botón
                ]) ?>
                <p>¡Gracias por leer! 😊</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Pasar las fechas y títulos de PHP a JavaScript
    var fechasEntradas = <?php echo json_encode($fechasYTitulos); ?>;
</script>


<!-- Calendario -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var verDetallesBtn = document.getElementById('verDetallesBtn');

        // Agregar un event listener al botón
        verDetallesBtn.addEventListener('click', function() {
            // Obtener la fecha de la entrada desde el atributo data-fecha del botón
            var fechaEntrada = this.getAttribute('data-fecha');
            if (fechaEntrada) {
                // Redirigir a la acción vistaDetalles con la fecha como parámetro
                window.location.href = '<?= Yii::$app->urlManager->createUrl(['site/vista-detalles', 'fecha' => '']) ?>' + fechaEntrada;
            } else {
                alert('Fecha no proporcionada.');
            }
        });

        var calendar = document.getElementById('calendar');
        var currentDate = new Date();
        var currentMonth = currentDate.getMonth();
        var currentYear = currentDate.getFullYear();

        function renderCalendar(month, year) {
            var firstDay = new Date(year, month, 1).getDay();
            var daysInMonth = new Date(year, month + 1, 0).getDate();
            var tbl = document.createElement('table');
            tbl.classList.add('calendar-table');

            var thead = document.createElement('thead');
            var daysRow = document.createElement('tr');
            var days = ['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom'];
            for (var i = 0; i < days.length; i++) {
                var th = document.createElement('th');
                th.appendChild(document.createTextNode(days[i]));
                daysRow.appendChild(th);
            }
            thead.appendChild(daysRow);
            tbl.appendChild(thead);

            var tbody = document.createElement('tbody');
            var date = 1;
            for (var i = 0; i < 6; i++) {
                var row = document.createElement('tr');
                for (var j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay) {
                        var cell = document.createElement('td');
                        cell.appendChild(document.createTextNode(''));
                        row.appendChild(cell);
                    } else if (date > daysInMonth) {
                        break;
                    } else {
                        var cell = document.createElement('td');
                        var cellDate = year + '-' + (month + 1).toString().padStart(2, '0') + '-' + date.toString().padStart(2, '0');
                        var entrada = fechasEntradas.find(e => e.fecha === cellDate);
                        if (entrada) {
                            cell.style.backgroundColor = '#fbffc4';
                            cell.setAttribute('title', entrada.titulo);
                            cell.setAttribute('data-fecha', entrada.fecha);
                        }
                        cell.appendChild(document.createTextNode(date));

                        cell.addEventListener('click', function() {
                            var entradaDetalle = document.getElementById('entradaDetalle');
                            var cellDate = this.getAttribute('data-fecha');
                            var entrada = fechasEntradas.find(e => e.fecha === cellDate);
                            if (entrada) {
                                var formattedDate = new Date(cellDate).toLocaleString('es-ES', { day: '2-digit', month: 'long', year: 'numeric' });

                                // Crear un div temporal para decodificar HTML
                                var tempDiv = document.createElement('div');
                                tempDiv.innerHTML = entrada.descripcion;
                                var descripcionDecodificada = tempDiv.textContent || tempDiv.innerText || '';

                                // Limitar título y descripción a 30 caracteres
                                var tituloCortado = entrada.titulo.length > 30 ? entrada.titulo.substring(0, 30) + '...' : entrada.titulo;
                                var descripcionCortada = descripcionDecodificada.length > 30 ? descripcionDecodificada.substring(0, 30) + '...' : descripcionDecodificada;

                                entradaDetalle.innerHTML = '<strong>Fecha:</strong> ' + formattedDate + '<br><strong>Título:</strong> ' + tituloCortado + '<br><strong>Descripción:</strong> ' + descripcionCortada;
                                var verDetallesBtn = document.getElementById('verDetallesBtn');
                                verDetallesBtn.setAttribute('data-fecha', entrada.fecha);
                                $('#entradaModal').modal('show');
                            }
                        });

                        if (date === currentDate.getDate() && month === currentDate.getMonth() && year === currentDate.getFullYear()) {
                            cell.style.backgroundColor = '#e6d7f6';
                            cell.style.color = '#B65598';
                            cell.classList.add('current-day');
                        }
                        row.appendChild(cell);
                        date++;
                    }
                }
                tbody.appendChild(row);
            }
            tbl.appendChild(tbody);

            var nav = document.createElement('div');
            nav.classList.add('calendar-nav');

            var prevBtn = document.createElement('button');
            prevBtn.innerHTML = '&lt;';
            prevBtn.addEventListener('click', function() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                renderCalendar(currentMonth, currentYear);
            });

            var nextBtn = document.createElement('button');
            nextBtn.innerHTML = '&gt;';
            nextBtn.addEventListener('click', function() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                renderCalendar(currentMonth, currentYear);
            });

            var title = document.createElement('div');
            title.classList.add('calendar-title');
            title.innerHTML = new Date(year, month).toLocaleString('es-ES', { month: 'long', year: 'numeric' });

            nav.appendChild(prevBtn);
            nav.appendChild(title);
            nav.appendChild(nextBtn);

            calendar.innerHTML = '';
            calendar.appendChild(nav);
            calendar.appendChild(tbl);
        }

        renderCalendar(currentMonth, currentYear);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todos los elementos td con atributo title
        var cellsWithTitle = document.querySelectorAll('.calendar-table td[title]');

        // Itera sobre cada elemento y agrega un event listener para el evento mouseover
        cellsWithTitle.forEach(function(cell) {
            cell.addEventListener('mouseover', function() {
                // Obtén el título y trunca el texto si supera los 20 caracteres
                var title = this.getAttribute('title');
                var truncatedTitle = title.length > 20 ? title.substring(0, 20) + '...' : title;

                // Establece el atributo title truncado
                this.setAttribute('title', truncatedTitle);
            });
        });
    });
</script>
