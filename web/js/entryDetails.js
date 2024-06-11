document.addEventListener("DOMContentLoaded", function () {
        const toggles = document.querySelectorAll(".toggle-description");
        toggles.forEach(function (toggle) {
            toggle.addEventListener("click", function (event) {
                event.preventDefault();
                const parentP = toggle.closest("p");
                const shortDescription = parentP.querySelector(".short-description");
                const fullDescription = parentP.querySelector(".full-description");

                if (shortDescription.style.display === "none") {
                    shortDescription.style.display = "inline";
                    fullDescription.style.display = "none";
                    toggle.textContent = "Ver más";
                } else {
                    shortDescription.style.display = "none";
                    fullDescription.style.display = "inline";
                    toggle.textContent = "Ver menos";
                }
            });
        });

        // Ajustar el ancho máximo basado en la longitud de la descripción
        const descripcion = document.getElementById("descripcion-texto").textContent.trim();
        const descripcionLength = descripcion.length;

        // Ajustar el ancho máximo basado en la longitud de la descripción
        let maxWidth;
        if (descripcionLength < 50) {
            maxWidth = "50%";
        } else if (descripcionLength < 100) {
            maxWidth = "75%";
        } else {
            maxWidth = "100%";
        }

        // Establecer el ancho máximo calculado
        document.querySelector(".entry-details2 .tarjeta_detalles").style.maxWidth = maxWidth;
    });