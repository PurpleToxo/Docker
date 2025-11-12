<?php

include_once ("libs/bases_datos.php");

$conexion=get_conexion();
select_DB($conexion);
$mensaje="";

if(isset($_GET["id"])){
    $id_user=$_GET["id"];
    borrar_usuario($conexion, $id_user);
    $mensaje="El usuario con id $id_user ha sido borrado con éxito.";
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Borrar registro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <?= $mensaje ?>
        <footer>
            <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
        </footer>
    </body>
</html>