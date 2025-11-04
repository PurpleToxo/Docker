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
        get_conexion();
        select_DB($conexion);
        create_table_user($conexion);
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
    </body>
</html>