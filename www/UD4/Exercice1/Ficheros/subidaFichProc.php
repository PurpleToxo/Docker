<?php
//Con esto: tenemos la carpeta donde se va a guarar y si no existe lo creamos.
$carpetaDestino = "files/";
if (!is_dir($carpetaDestino)){
    mkdir($carpetaDestino, 0755, true);
}
//Comprobar si hay archivo
if(isset($_FILES['fichero'])){
    $archivo = $_FILES['fichero'];
    $nombre = $_POST['nombre'];
    $tipo =$archivo['type'];
    $tamano=$archivo['size'];
    $tmp=$archivo['tmp_name'];
    $descripcion = $_POST['descripcion'];


    //validar archivos
    $tiposPermitidos =['image/jpg', 'image/png','application/pdf'];
    if(!in_array($tipo, $tiposPermitidos)){
        die("Archivo no permitido.");
    }
    //Validacion del tamaño
    if($tamano > 20 *1024 *1024){
        die("El archivo es muy grande.");
    }
    //para no repetir nombre
    $nuevoNombre = time() . "_" .$nombre;
    //Mover archivo a destino
    if(move_uploaded_file($tmp, $carpetaDestino . $nuevoNombre)){
        $tarea_id = $_POST['tarea_id'];
        require_once '../../modelo/mysqli.php';
        nuevoFichero($nuevoNombre,$archivo,$descripcion, $id_tarea);
        //$nombre, $file, $descripcion, $id_tarea
        echo "Hubo problemas al subir el archivo.";
    }
}else{
    echo "No seEnvio archivo.";
}
?>
