<?php
/**Listar los ficheros */




?>
<?php
$carpeta = "uploads/";

echo "<h2>Archivos subidos</h2>";

// Comprobar que la carpeta existe
if (is_dir($carpeta)) {
    $archivos = scandir($carpeta); // devuelve un array con . y ..
    echo "<ul>";
    foreach ($archivos as $archivo) {
        if ($archivo != "." && $archivo != "..") {
            echo "<li><a href='$carpeta$archivo' target='_blank'>$archivo</a></li>";
        }
    }
    echo "</ul>";
} else {
    echo "No hay archivos.";
}


?>