
    document.addEventListener('DOMContentLoaded', function() {
        // Se selecciona el botón usando su ID real del HTML: 'maximizeToggle'
        const boton = document.getElementById('refresh');

        if (boton) {
            boton.addEventListener('click', function(event) {
                // Detiene la navegación predeterminada
                event.preventDefault(); 
                
                // Recarga la página actual
                window.location.reload(); 
            });
        }
    });