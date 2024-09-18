// Función de validación del formulario
function validarFormulario() {
    // Obtener los valores de los campos del formulario
    var nombre = document.forms["formulario"]["Nombres"].value;
    var apellido = document.forms["formulario"]["Apellido"].value;
    var edad = document.forms["formulario"]["Edad"].value;
    var correo = document.forms["formulario"]["Correo"].value;
    var dni = document.forms["formulario"]["Control"].value;

    // Validar campos vacíos y mostrar alertas específicas
    if (nombre === "") {
        alert("El campo Nombre es obligatorio.");
        return false;
    }

    if (apellido === "") {
        alert("El campo Apellido es obligatorio.");
        return false;
    }

    if (edad === "") {
        alert("El campo Edad es obligatorio.");
        return false;
    }

    if (correo === "") {
        alert("El campo Correo es obligatorio.");
        return false;
    }

    if (dni === "") {
        alert("El campo DNI es obligatorio.");
        return false;
    }

    // Validar que edad sea un número entero positivo
    if (!/^\d+$/.test(edad)) {
        alert("La edad debe ser un número entero positivo.");
        return false;
    }

    // Validar formato del correo electrónico
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(correo)) {
        alert("El correo electrónico no es válido.");
        return false;
    }

    // Si todo está bien, permitir el envío del formulario
    return true;
}
