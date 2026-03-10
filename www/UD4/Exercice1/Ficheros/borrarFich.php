<?php
//borrar ficheros

require_once "../modelo/mysqli.php";

$id_fichero = $_POST['id'];

borrarFichero($id_fichero);

header("Location: tareas.php");


?>