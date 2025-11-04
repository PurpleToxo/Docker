<?php
include_once("libs/bases_datos.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Tienda ej 1</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <?php
        //Primer paso abrir la conexion con la base de datos, crear tablas si no existen
        $conexion=get_conexion();
        crear_DB($conexion);
        select_DB($conexion);
        create_user_table($conexion);
        ?>

        <h1>Formulario para inscripción de usuarios</h1>
        <br>
        <a href="dar_alta.php" class="btn btn-primary">Dar de alta usuario</a>
        <br><br>

        <h1>Listar usuarios</h1>
        <br>
        <a href="listar.php" class="btn btn-secondary">Listar usuarios</a>
        <br><br>

        <h1>Modificar usuarios</h1>
        <br>
        <a href="editar.php" class="btn btn-info">Modificar usuarios</a>
        <br><br>
        <h1>Eliminar usuarios</h1>
        <br>
        <a href="borrar.php" class="btn btn-dark">Eliminar usuarios</a>
        <br>
    
        <footer>
            <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
        </footer>
    </body>
</html>