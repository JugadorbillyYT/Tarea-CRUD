<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gestión de estudiantes con CRUD en PHP. Añade, edita y elimina estudiantes fácilmente.">
    <meta name="keywords" content="CRUD, PHP, gestión de estudiantes, lista de alumnos">
    <title>Crud en php</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <?php 
    
    include("conexion.php");
    //select * from alumno
    $sql="select * from alumno";
    $resultado=mysqli_query($conexion, $sql);

    ?>
    <h1>Lista de Estudiantes</h1>
    <a href="agregar.php">Nuevo estudiante</a></br></br>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Correo</th>
                <th>DNI</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($filas=mysqli_fetch_assoc($resultado)){
            ?>
            <tr>
                <td><?php echo $filas['id'] ?></td>
                <td><?php echo $filas['Nombres'] ?></td>
                <td><?php echo $filas['Apellido'] ?></td>
                <td><?php echo $filas['Edad'] ?></td>
                <td><?php echo $filas['Correo'] ?></td>
                <td><?php echo $filas['Control'] ?></td>
                <td>
                    <?php echo "<a href='editar.php?id=".$filas['id']."'>Editar</a>";?> -
                <?php echo "<a href='eliminar.php?id=".$filas['id']."'>Eliminar</a>";?>
            </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php
    mysqli_close($conexion);
    ?>
</body>
</html>