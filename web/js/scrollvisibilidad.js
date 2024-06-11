       //Script para esconder lar tarjetas y hacerlas visibles con el scroll.
       
       document.addEventListener('DOMContentLoaded', function () {
    var entries = document.querySelectorAll('.entry');

    function checkVisibility() {
        entries.forEach(function (entry) {
            if (isVisible(entry)) {
                entry.classList.add('visible');
            } else {
                entry.classList.remove('visible'); //Borra la clase .visible cuando la entrada no es visible
            }
        });
    }

    function isVisible(element) {
    var rect = element.getBoundingClientRect();
    var windowHeight = (window.innerHeight || document.documentElement.clientHeight);
    var windowWidth = (window.innerWidth || document.documentElement.clientWidth);

    
    var offset = 100; //para que sea visible

    return (
        rect.top >= -offset &&
        rect.left >= -offset &&
        rect.bottom <= (windowHeight + offset || document.documentElement.clientHeight + offset) &&
        rect.right <= (windowWidth + offset || document.documentElement.clientWidth + offset)
    );
}


    //Verifica la visibilidad de las entradas al cargar la página y al hacer scroll
    checkVisibility();
    window.addEventListener('scroll', checkVisibility);
});

