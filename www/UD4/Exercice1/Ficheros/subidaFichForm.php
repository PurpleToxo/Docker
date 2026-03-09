<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD3. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once('../vista/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once('../vista/menu.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Subir fichero</h2>
                </div>
                <div class="container justify-content-between">
                    <form action="subidaFichProc.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($nombre) ? ($nombre) : '' ?>" required>
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo isset($descripcion) ? ($descripcion) : '' ?>" required>
                            <label for="fichero" class="form-label">Selecciona un fichero</label>
                            <input type="hidden" name="tarea_id" value="<?= $tarea_id ?>"> 
                            <input type="file" class="form-control" id="fichero" name="fichero" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir</button>

                </div>
            </main>
        </div>
    </div>

    <?php include_once('../vista/footer.php'); ?>
    
</body>
</html>
