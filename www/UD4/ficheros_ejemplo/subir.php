<?php
// Nombre del directorio donde se guardarán los archivos subidos
$targetDir = __DIR__ . '/uploads/';

// Asegurarse de que la carpeta existe y tiene permisos de escritura
if (!is_dir($targetDir) && !mkdir($targetDir, 0777, true)) {
    die('Error: no se puede crear la carpeta de destino.');
}

// Nombre del campo input en el formulario
$fieldName = 'fileToUpload';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES[$fieldName])) {
        die('Error: no se ha enviado ningún archivo.');
    }

    $file = $_FILES[$fieldName];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Error en la subida: ' . $file['error']);
    }

    // Verificar tamaño máximo (por ejemplo, 500 KB)
    if ($file['size'] > 500000) {
        die('El archivo es demasiado grande.');
    }

    // Nombre seguro del archivo y ruta destino
    $fileName = basename($file['name']);
    $targetFile = $targetDir . $fileName;

    // Extensión del archivo en minúsculas
    $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Extensiones permitidas (ejemplo)
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'txt', 'pdf'];

    if (!in_array($fileExtension, $allowedExtensions, true)) {
        die('Tipo de archivo no permitido. Solo se aceptan: ' . implode(', ', $allowedExtensions));
    }

    // Comprobar si el archivo ya existe
    if (file_exists($targetFile)) {
        die('El fichero ya existe.');
    }

    // Mover el archivo desde la carpeta temporal a la carpeta uploads
    if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
        die('Error al mover el archivo al directorio de destino.');
    }

    echo '<!DOCTYPE html>';
    echo '<html lang="es"><head><meta charset="UTF-8"><title>Resultado</title></head><body>';
    echo '<h1>Archivo subido correctamente</h1>';
    echo '<p>Nombre: ' . htmlspecialchars($fileName, ENT_QUOTES, 'UTF-8') . '</p>';
    echo '<p>Tamaño: ' . htmlspecialchars($file['size'], ENT_QUOTES, 'UTF-8') . ' bytes</p>';
    echo '<p>Tipo: ' . htmlspecialchars($file['type'], ENT_QUOTES, 'UTF-8') . '</p>';
    echo '<p><a href="formulario.php">Volver al formulario</a></p>';
    echo '</body></html>';
} else {
    die('Acceso inválido. Usa el formulario para subir el archivo.');
}
