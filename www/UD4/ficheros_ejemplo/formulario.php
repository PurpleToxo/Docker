<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subida de archivo - Ejemplo</title>
</head>
<body>
    <h1>Subida de archivo</h1>
    <p>Este formulario envía un archivo a <strong>subir.php</strong> mediante POST y multipart/form-data.</p>

    <form action="subir.php" method="post" enctype="multipart/form-data">
        <label>
            Selecciona un archivo:
            <input type="file" name="fileToUpload" required>
        </label>
        <br><br>
        <button type="submit">Subir archivo</button>
    </form>

    <p>La carpeta de destino es <code>uploads/</code>.</p>
</body>
</html>
