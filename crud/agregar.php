<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Agrega un nuevo estudiante al sistema CRUD. Completa los campos requeridos para añadir un nuevo alumno.">
    <meta name="keywords" content="Agregar estudiante, CRUD, PHP, gestión de alumnos">
    <title>Agregar Estudiante</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script>
        // Función de validación del formulario
        function validarFormulario() {
            // Obtener los valores de los campos del formulario
            var nombre = document.forms["formulario"]["Nombres"].value;
            var apellido = document.forms["formulario"]["Apellido"].value;
            var edad = document.forms["formulario"]["Edad"].value;
            var correo = document.forms["formulario"]["Correo"].value;
            var dni = document.forms["formulario"]["Control"].value;

            // Validar campo Nombre
            if (nombre === "") {
                alert("El campo Nombre es obligatorio.");
                return false;
            }

            // Validar campo Apellido
            if (apellido === "") {
                alert("El campo Apellido es obligatorio.");
                return false;
            }

            // Validar campo Edad
            if (edad === "") {
                alert("El campo Edad es obligatorio.");
                return false;
            } else if (!/^\d+$/.test(edad)) {
                alert("La edad debe ser un número entero positivo.");
                return false;
            }

            // Validar campo Correo
            if (correo === "") {
                alert("El campo Correo es obligatorio.");
                return false;
            } else {
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(correo)) {
                    alert("El correo electrónico no es válido.");
                    return false;
                }
            }

            // Validar campo DNI
            if (dni === "") {
                alert("El campo DNI es obligatorio.");
                return false;
            } else if (!/^\d{9}$/.test(dni)) {
                alert("El DNI debe contener exactamente 9 dígitos.");
                return false;
            }

            // Si todo está bien, permitir el envío del formulario
            return true;
        }
    </script>
</head>
<body>
    <?php
    if (isset($_POST['enviar'])) {
        $nombre = $_POST['Nombres'];
        $apellido = $_POST['Apellido'];
        $edad = $_POST['Edad'];
        $correo = $_POST['Correo'];
        $dni = $_POST['Control'];

        include("conexion.php");

        // Prepara la declaración para evitar inyección SQL
        $stmt = $conexion->prepare("INSERT INTO alumno (Nombres, Apellido, Edad, Correo, Control) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $apellido, $edad, $correo, $dni);

        if ($stmt->execute()) {
            echo "<script language='JavaScript'>
                console.log('Los datos fueron ingresados correctamente');
                window.location.assign('index.php');
            </script>";
        } else {
            echo "<script language='JavaScript'>
                console.log('ERROR: No se pudieron ingresar los datos');
                window.location.assign('index.php');
            </script>";
        }

        $stmt->close();
        $conexion->close();
    }
    ?>
    <h1>Agregar Nuevo Alumno</h1>
    <form name="formulario" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return validarFormulario()">
        <label>Nombre</label>
        <input type="text" name="Nombres" required></br>
        <label>Apellido</label>
        <input type="text" name="Apellido" required></br>
        <label>Edad</label>
        <input type="text" name="Edad" required></br>
        <label>Correo</label>
        <input type="text" name="Correo" required></br>
        <label>DNI</label>
        <input type="text" name="Control" required></br>
        <input type="submit" name="enviar" value="Agregar">
        <a href="index.php">Regresar</a>
    </form>
</body>
</html>
