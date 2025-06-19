// Menú desplegable universal
function toggleMenu() {
    var menu = document.getElementById("menuContent");
    if (menu) {
        menu.style.display = (menu.style.display === "block") ? "none" : "block";
    }
}

// Cierra el menú si se hace clic fuera
document.addEventListener("click", function (event) {
    if (!event.target.matches('.menu-btn')) {
        var dropdowns = document.getElementsByClassName("menu-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === "block") {
                openDropdown.style.display = "none";
            }
        }
    }
});

// Validación de inicio de sesión (simulada, reemplazar por PHP en producción)
const loginForm = document.getElementById("loginForm");
if (loginForm) {
    loginForm.addEventListener("submit", function (event) {
        event.preventDefault();
        let usuario = document.getElementById("username").value.trim();
        let contraseña = document.getElementById("password").value.trim();
        let mensajeError = document.getElementById("errorMsg");
        if (usuario === "admin" && contraseña === "1234") {
            window.location.href = "administrador.html";
        } else {
            mensajeError.textContent = "Usuario o contraseña incorrectos";
        }
    });
}

// Validación de registro de cliente
const registroForm = document.querySelector('form[action="php/registro_personas.php"]');
if (registroForm) {
    registroForm.addEventListener("submit", function (event) {
        let valid = true;
        let mensajes = [];
        // Validar campos requeridos
        const campos = [
            "tipo_documento", "Numero_documento", "Primer_nombre", "Segundo_nombre",
            "Primer_apellido", "Fecha_Nacimiento", "Correo", "Telefono", "sexo"
        ];
        campos.forEach(id => {
            const el = document.getElementById(id);
            if (el && !el.value.trim()) {
                valid = false;
                mensajes.push(`El campo ${el.placeholder || el.name || id} es obligatorio.`);
            }
        });
        // Validar email
        const email = document.getElementById("Correo");
        if (email && !/^\S+@\S+\.\S+$/.test(email.value)) {
            valid = false;
            mensajes.push("El correo electrónico no es válido.");
        }
        // Validar teléfono
        const tel = document.getElementById("Telefono");
        if (tel && !/^\d{10}$/.test(tel.value)) {
            valid = false;
            mensajes.push("El teléfono debe tener 10 dígitos numéricos.");
        }
        if (!valid) {
            event.preventDefault();
            alert(mensajes.join("\n"));
        }
    });
}

// Validación de recuperación de contraseña (simulada)
const recoveryForm = document.getElementById("recoveryForm");
if (recoveryForm) {
    recoveryForm.addEventListener("submit", function (event) {
        event.preventDefault();
        const emailInput = recoveryForm.querySelector('input[type="email"]');
        if (!emailInput.value || !/^\S+@\S+\.\S+$/.test(emailInput.value)) {
            alert("Por favor ingresa un correo electrónico válido.");
            return;
        }
        alert(`Se ha enviado un enlace de recuperación a: ${emailInput.value}\n(Simulación)`);
        window.location.href = "login.html";
    });
}
