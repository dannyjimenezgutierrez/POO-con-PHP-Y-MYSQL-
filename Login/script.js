document.addEventListener("DOMContentLoaded", () => {
    // Referencia a los elementos del formulario
    const form = document.getElementById("loginForm");
    const usuario = document.getElementById("usuario");
    const clave = document.getElementById("clave"); // Usar el ID correcto
    const passwordToggle = document.getElementById("passwordToggle");
    const toggleIcon = document.getElementById("toggleIcon");
    const errorUsuario = document.getElementById("errorUsuario");
    const errorClave = document.createElement("div"); // Usar una nueva variable para el error de la clave
    
    // Añadir el contenedor de error de la clave al DOM
    clave.parentElement.parentElement.appendChild(errorClave);

    /* Lógica del icono del ojo para visualizar/ocultar la clave */
    passwordToggle.addEventListener('click', function () {
        if (clave.type === 'password') {
            clave.type = 'text';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        } else {
            clave.type = 'password';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        }
    });

    /* Lógica de validación del formulario */
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const usuarioValido = validarUsuario();
        const claveValida = validarClave(); // Usar la nueva función

        if (!usuarioValido || !claveValida) {
            return;
        }

        form.submit();
    });

    // Validar en tiempo real mientras el usuario escribe
    usuario.addEventListener("input", () => {
        validarUsuario();
    });

    clave.addEventListener("input", () => {
        validarClave(); // Usar la nueva función
    });

    function validarUsuario() {
        errorUsuario.innerHTML = "";

        if (usuario.value.trim() === "") {
            mostrarAlerta(errorUsuario, "❌ El usuario es obligatorio.", "red");
            return false;
        } else if (usuario.value.length < 4) {
            mostrarAlerta(errorUsuario, "⚠️ Debe tener al menos 4 caracteres.", "yellow");
            return false;
        } else if (!/^[a-zA-Z0-9_]+$/.test(usuario.value)) {
            mostrarAlerta(errorUsuario, "ℹ️ Solo se permiten letras, números y guiones bajos.", "blue");
            return false;
        }

        return true;
    }

    function validarClave() {
        errorClave.innerHTML = "";

        if (clave.value.trim() === "") {
            mostrarAlerta(errorClave, "❌ La contraseña es obligatoria.", "red");
            return false;
        } else if (clave.value.length < 8) {
            mostrarAlerta(errorClave, "⚠️ La contraseña debe tener al menos 8 caracteres.", "yellow");
            return false;
        } else if (!/(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*()_+[\]{};':"\\|,.<>/?-])/.test(clave.value)) {
            mostrarAlerta(errorClave, "ℹ️ Debe incluir al menos una letra, un número y un caracter especial.", "blue");
            return false;
        }

        return true;
    }

    function mostrarAlerta(contenedor, mensaje, color) {
        contenedor.innerHTML = `
          <div class="bg-${color}-100 border border-${color}-400 text-black px-4 py-2 rounded relative mt-2" role="alert">
            ${mensaje}
          </div>`;
    }



    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');

    let titulo = '';
    let mensaje = '';
    let icono = '';

    // Definimos el mensaje y el icono según el tipo de error
    switch (error) {
        case 'usuario_no_encontrado':
            mensaje = 'El usuario no está registrado.';
            icono = 'question';
            break;
        case 'clave_incorrecta':
            mensaje = 'La clave es incorrecta.';
            icono = 'info';
            break;
        case 'usuario_inactivo': // <-- Agrega este nuevo caso
            mensaje = 'Su cuenta está inactiva. Contacte al administrador.';
            icono = 'warning'; // Puedes usar un icono diferente como 'warning'
            break;
        case 'credenciales_invalidas':
            mensaje = 'Credenciales inválidas.';
            icono = 'error';
            break;
        default:
            return; // No hacemos nada si no hay error
    }
    

    // Si hay un mensaje, mostramos la alerta de SweetAlert2
    if (mensaje) {
        Swal.fire({
            icon: icono,
            title: titulo,
            text: mensaje,
            imageUrl: "logo-VTV.png",
            width: 400,
            height: 800,
            confirmButtonColor: '#444550ff', 
            confirmButtonText: 'Aceptar'
        }).then(() => {
            // Limpiamos el parámetro de la URL después de que el usuario cierra la alerta
            // Esto evita que la alerta reaparezca al recargar la página
            const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            window.history.replaceState({}, document.title, newUrl);
        });
    }
});