<?php
include_once("libs/bases_datos.php");

$conexion=get_conexion();
select_DB($conexion);

$id_user=0;
$nombre="";
$apellidos="";
$edad=0;
$provincia="corunha";
$mensaje="";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit"])) {
    $id_user=$_POST["id"];
    $nombre = $_POST["nombre"];
    $apellidos=$_POST["apellidos"];
    $edad=$_POST["edad"];
    $provincia=$_POST["provincia"];
    $mensaje="El usuario $nombre $apellidos de  $edad años de edad y de la provincia de  $provincia ha sido editado con éxito.";
            

    editar_user($conexion, $id_user, $nombre, $apellidos, $edad, $provincia);
} else {
    if(isset($_GET["id"])){
        
        $id_user=$_GET["id"];

        $user = buscar_usuario($conexion, $id_user);
        
        if($user->num_rows >0){
            $row=$user->fetch_assoc();
            $id_user=$row['id'];
            $nombre=$row['nombre'];
            $apellidos=$row['apellidos'];
            $edad=$row['edad'];
            $provincia=$row['provincia'];
        }
    }else{
            $id_user=0;
            $nombre="";
            $apellidos="";
            $edad=0;
            $provincia="corunha";
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