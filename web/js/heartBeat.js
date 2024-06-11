document.addEventListener("DOMContentLoaded", function () {
    var cardInners = document.querySelectorAll(".card-inner");

    cardInners.forEach(function (cardInner) {
        cardInner.classList.add("heartbeat-animation");

        cardInner.addEventListener("mouseenter", function () {
            this.classList.remove("heartbeat-animation");
        });

        cardInner.addEventListener("mouseleave", function () {
            this.classList.add("heartbeat-animation");
        });
    });

    // JavaScript para manejar el "ver más" y "ver menos" en descripciones y títulos
    var processText = function (elements, maxLength, smallLinkClass = '') {
        elements.forEach(function (element) {
            var fullText = element.textContent;
            if (fullText.length > maxLength) {
                var shortText = fullText.substring(0, maxLength);
                element.textContent = shortText;

                var toggleLink = document.createElement('a');
                toggleLink.textContent = '...';
                toggleLink.href = '#';
                toggleLink.className = 'toggle-link ' + smallLinkClass;
                toggleLink.addEventListener('click', function (event) {
                    event.preventDefault();
                    if (toggleLink.textContent.trim() === '...') {
                        element.textContent = fullText;
                        toggleLink.textContent = ' ver menos';
                    } else {
                        element.textContent = shortText;
                        toggleLink.textContent = '...';
                    }
                    element.appendChild(toggleLink);
                });

                element.appendChild(toggleLink);
            }
        });
    };

    // Procesar descripciones y títulos
    processText(document.querySelectorAll(".description"), 40);
    processText(document.querySelectorAll(".card-header h3"), 25, 'small-toggle-link');
});


// Función para limitar la descripción a 40 caracteres
document.addEventListener("DOMContentLoaded", function () {
    var limitDescription = function (elements, maxLength) {
        elements.forEach(function (element) {
            var fullText = element.textContent;
            if (fullText.length > maxLength) {
                var shortText = fullText.substring(0, maxLength) + '...';
                element.textContent = shortText;
            }
        });
    };

    // Limitar descripciones a 40 caracteres
    limitDescription(document.querySelectorAll(".description"), 40);
});