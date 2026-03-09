<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once('vista/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once('vista/menu.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <h2>Detalle de la tarea</h2>
            <?php

                    $resultado = null;
                    if (!empty($_GET)){
                        $id_tarea = $_GET['id'];
                        require_once('../modelo/mysqli.php');
                        $resultado = buscaTarea($id_tarea);
                    }
                ?>

            <div class="table">
                <table class="table table-sm table-striped table-hover">
                    <thead class="thead">
                        <tr>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($resultado){
                                    echo '<tr>';
                                    echo '<td>' . $resultado['titulo'] . '</td>';
                                    echo '<td>' . $resultado['descripcion'] . '</td>';
                                    echo '<td>' . $resultado['estado'] . '</td>';
                                    echo '<td>' . $resultado['usuario'] . '</td>';
                                    echo '<td>';
                                    echo '<a class="btn btn-sm btn-outline-success" href="subidaFichForm.php?id=' . $resultado['id'] . '" role="button">Subir ficheros</a>';
                                    echo '<a class="btn btn-sm btn-outline-danger ms-2" href="listaFich.php?id=' . $resultado['id'] . '" role="button">Lista de ficheros</a>';
                                    echo '</td>';
                                    echo '</tr>';
                            }else{
                                echo '<tr><td colspan="100">No hay tareas</td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>

        </main>

        </div>
    </div>

    <?php include_once('vista/footer.php'); ?>
    
</body>
</html>