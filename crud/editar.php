<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Agrega un nuevo estudiante al sistema CRUD. Completa los campos requeridos para añadir un nuevo alumno.">
    <meta name="keywords" content="Agregar estudiante, CRUD, PHP, gestión de alumnos">
    <title>Editar Estudiante</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script src="validacion.js" defer></script>
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
    // Incluir el archivo de conexión
    include("conexion.php");

    // Verificar si se está enviando el formulario para actualizar
    if (isset($_POST['enviar'])) {
        $id = $_POST['id'];
        $nombre = $_POST['Nombres'];
        $apellido = $_POST['Apellido'];
        $edad = $_POST['Edad'];
        $correo = $_POST['Correo'];
        $dni = $_POST['Control'];

        // Preparar y ejecutar la consulta de actualización
        $stmt = $conexion->prepare("UPDATE alumno SET Nombres=?, Apellido=?, Edad=?, Correo=?, Control=? WHERE id=?");
        $stmt->bind_param("ssssis", $nombre, $apellido, $edad, $correo, $dni, $id);

        if ($stmt->execute()) {
            // Si la actualización fue exitosa
            echo "<script language='JavaScript'>
                console.log('Los datos fueron actualizados correctamente');
                window.location.assign('index.php');
            </script>";
        } else {
            // Si hubo un error al actualizar los datos
            echo "<script language='JavaScript'>
                console.log('ERROR: No se pudieron actualizar los datos');
                window.location.assign('index.php');
            </script>";
        }
        $stmt->close();
        $conexion->close();
    } else {
        // Obtener el ID del estudiante
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        // Preparar y ejecutar la consulta para obtener los datos del estudiante
        $stmt = $conexion->prepare("SELECT * FROM alumno WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        // Verificar si se obtuvo el registro
        if ($fila = $resultado->fetch_assoc()) {
            $nombre = $fila['Nombres'];
            $apellido = $fila['Apellido'];
            $edad = $fila['Edad'];
            $correo = $fila['Correo'];
            $dni = $fila['Control'];
        }  else {
            echo "<script language='JavaScript'>
                console.log('ERROR: No se encontró el estudiante');
                window.location.assign('index.php');
            </script>";
            exit;
        }

        $stmt->close();
        $conexion->close();
    }
?>

    <h1>Editar Estudiante</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return validarFormulario()">
        <label>Nombre</label>
        <input type="text" name="Nombres" value="<?php echo htmlspecialchars($nombre); ?>" required></br>
        <label>Apellido</label>
        <input type="text" name="Apellido" value="<?php echo htmlspecialchars($apellido); ?>" required></br>
        <label>Edad</label>
        <input type="text" name="Edad" value="<?php echo htmlspecialchars($edad); ?>" required></br>
        <label>Correo</label>
        <input type="text" name="Correo" value="<?php echo htmlspecialchars($correo); ?>" required></br>
        <label>DNI</label>
        <input type="text" name="Control" value="<?php echo htmlspecialchars($dni); ?>" required></br>

        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <input type="submit" name="enviar" value="Actualizar">
        <a href="index.php">Regresar</a>
    </form>
</body>
</html>
