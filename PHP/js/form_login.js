/**
 * * Descripción: hace la peticion a la api para obtener el captcha
 * *
 * *
 * * @author Marc Bordes Gómez <al405682@uji.es> 
 * * @author Elías Martín Cardozo <al405647@uji.es>
 * * @copyright 2023 Bordes-Cardozo
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 **/


async function obtenerCaptcha() {
    try {
        const response = await fetch("/partials/captchagenerator.php");
        const data = await response.json();

        if (data.success) {
            console.log(data.success);
            document.getElementById("captchaImage").src = "data:image/jpg;base64," + data.image;
            document.getElementById("idTypeInput").value = data.idType;
        } else {
            console.error("Error al obtener la imagen captcha:", data.message);
        }
    } catch (error) {
        console.error("Error en la solicitud a la API:", error);
    }
}

// Función para validar el formulario antes de enviarlo
function validarFormulario() {
    const usuarioInput = document.getElementById("user");

    // Validar el usuario
    const usuario = usuarioInput.value.trim(); // Eliminar espacios en blanco al principio y al final
    if (usuario === "" || usuario.length > 15 || !/^[a-zA-Z]+$/.test(usuario)) {
        alert("Nombre de usuario no válido. Debe contener solo letras y tener como máximo 12 caracteres.");
        return;
    }
    // Si la validación es exitosa, puedes enviar el formulario
    document.forms["form_usuario"].submit();
}

// Evento de clic en el botón de enviar
document.getElementById("submitBtn").addEventListener("click", function (event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto
    validarFormulario(); // Llamar a la función de validación antes de enviar
});

obtenerCaptcha();