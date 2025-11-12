<?php
include_once("libs/data_base.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Tienda ej 2</title>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="style/index.css">
    </head>
    <body>
        <?php include_once ("style/header.html"); ?>
        <main>
            <h3>Donacion de Sangre</h3>

            <p> Alta nuevos donantes</p>
            <a href="newDonor.php" class="btn btn-primary">Dar de alta nuevo donante</a>

            <p> Listar donantes</p>
            <a href="list_donors.php" class="btn btn-primary">Listar donates</a>
        </main>


        <?php include_once ("style/footer.html"); ?>
    </body>
</html>