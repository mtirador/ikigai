$('#guardar-btn').on('click', function(e) {
    e.preventDefault(); // Evita que el formulario se envíe automáticamente
    $('#popup-confirmacion').fadeIn(); // Mostrar el popup de confirmación
});

$('#confirmar-guardar').on('click', function() {
    $('#popup-confirmacion').fadeOut(); // Ocultar el popup de confirmación
    $('#guardar-btn').closest('form').submit(); // Enviar el formulario
});

$('#cancelar-guardar').on('click', function() {
    $('#popup-confirmacion').fadeOut(); // Ocultar el popup de confirmación
});
