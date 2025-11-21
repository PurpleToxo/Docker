<?php
/*Valida los datos en PHP antes de guardarlos en la base de datos. Ver el apartado “Formularios” de la UD02.
Guarda los datos en la tabla de base de datos. */

include_once("libs/data_base.php");
include_once("libs/utils.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Tienda 2</title>
        <meta chartset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="style/index.css">
        
    </head>
    <body>
        <?php include_once ("style/header.html"); 
        $mensaje=""; 
        if($_SERVER['REQUEST_METHOD']==="POST" && isset($_POST['submit'])){
            $nombre= validate($_POST['name']);
            $apellidos=validate($_POST['apellidos']);
            $age=validate($_POST['age']);
            $grp_sangre=validate($_POST['grp_sangre']);
            $cod_postal=validate($_POST['cod_postal']);
            $tlf=validate($_POST['tlf']);
           
           
            $connection = getConnection();
            select_DB($connection);

        }


        
        ?>
        <main>
            <div class="form-container">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <label for="name"> Nombre</label>
                    <input type="text" name="name" id="name">

                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos">
                    
                    <label for="age">Edad</label>
                    <input type="number" name="age" id="age">
                    
                    <label for="grp_sangre">Grupo sanguíneo</label>
                    <select id="grp_sangre" name="grp_sangre"> 
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="0+">0+</option>
                        <option value="0-">0-</option>
                    </select>
                    
                    
                    <label for="cod_postal">Código postal</label>
                    <input type="text" name="cod_postal" id="cod_postal">
                    
                    <label for="tlf">Teléfono</label>
                    <input type="text" name="tlf" id="tlf">

                    <input type="button" name="submit" class="btn btn-primary" value="Enviar">
                </form>
            </div>

        
        </main>
        <?php include_once ("style/footer.html"); ?>
    </body>
</html>