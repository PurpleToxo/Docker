<?php

include_once("/libs/bases_datos.php");

$conexion=connection();


$mensaje="";
$id_user="";
$nombre="";
$apellidos="";
$edad="";
$provincia="";

if($_SERVER(['REQUEST_METHOD']==="POST" && isset($_POST['submit']))){
    $nombre= validate($_POST['nombre']);
    $apellidos= validate($_POST['apellidos']);
    $edad= validate($_POST['edad']);  
    $provincia= validate($_POST['provincia']);

    select_DB($conexion);
    edit_user($conexion, $nombre, $apellidos, $edad, $provincia);
    close_connection($connection);


}else{
    if(isset($_GET['id'])){
        $id_user=$_GET['id'];
        $usuario= get_user($conexion,$id_user);
        if($usuario->num_rows>0){
            $row=$usuario->fetch_assoc();
            $id_user=$row['id'];
            $nombre=$row['nombre'];
            $apellidos=$row['apellidos'];
            $edad=$row['edad'];
            $provincia=$row['provincia'];
        }
    }else{
        $id_user="";
        $nombre="";
        $apellidos="";
        $edad="";
        $provincia="";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Usuario</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <h1> Editar usuario</h1>

        <?= $mensaje; ?>
        <!--MEnsaje de editado correctamente-->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>">
            <!-- id oculto necesario para enviar el identificador al hacer submit -->
            <input type="hidden" name="id" value="<?=$id_user?>">
            <p>Nombre</p>
            <input type="text" name="nombre" value=<?=$nombre?>>
            <br><br>
            <p>Apellidos</p>
            <input type="text" name="apellidos" value=<?=$apellidos?>>
            <br><br>
            <p>Edad</p>
            <input type="number" name="edad"  value=<?=$edad?>>
            <br><br>
            <p>Provincia</p>
            <select name="provincia">
                <option value="Corunha">A Coruña</option>
                <option value="Pontevedra">Pontevedra</option>
                <option value="Lugo">Lugo</option>
                <option value="Ourense">Ourense</option>
            </select><br><br>
            <input type="submit" name="submit" value="Enviar">
        </form>



    <footer>
            <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
        </footer>
    </body>
</html>