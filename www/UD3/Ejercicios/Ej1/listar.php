<?php
include_once("libs/utiles.php");
include_once("libs/bases_datos.php");
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Listado de usuarios</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <h1>Listado de usuarios</h1>
        <table> <!--Diseñamos la cabecera de la tabla-->
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Edad</th>
                    <th>Provincia</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
        <?php //insertamos el codigo php responsable de encontrar y gestionar la información de la base de datos
        $conexion = get_conexion(); //Guardamos en una variable la conexion a la base de datos
        select_DB($conexion);//Seleccionamos la base de datos con la que vamos a trabajar
        $sql="SELECT *FROM USUARIOS";//Guardamos en una variable la consulta SQL que queremos ejecutar
        $resultado = $conexion->query($sql);//Guardamos el resultado de aplicar la consulta a la base de datos
        if($resultado===false){
            //En caso de que de error en la consulta
            error_log("Error en la consilta: ".$conexion->error);
            echo ("Error en la consulta");
        }else{
            if($resultado->num_rows >0){
                //Si no da error y tiene al menos 1 resultado
                while($row = $resultado->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".htmlspecialchars($row['nombre'])."</td>";
                    echo "<td>".htmlspecialchars($row['apellidos'])."</td>";
                    echo "<td>".htmlspecialchars($row['edad'])."</td>";
                    echo "<td>".htmlspecialchars($row['provincia'])."</td>";
                    // Corregir atributos y comillas para que el id se pase correctamente en GET
                    echo '<td><a href="editar.php?id=' . $row['id'] . '" class="btn btn-info">Editar</a></td>';
                    echo '<td><a href="borrar.php?id=' . $row['id'] . '" class="btn btn-danger">Borrar</a></td>';

                    echo "</tr>";
                }
                $resultado->free();
            }else{
                //Si no hay resultados
                echo "no hay resultados";
            }
        }   
        $conexion->close();//Cerramos la conexion a la base de datos         
        ?>
        </tbody>
        </table>


        <footer>
            <a href="index.php" class="btn btn-secondary">Volver al inicio</a>
        </footer>
    </body>
</html>