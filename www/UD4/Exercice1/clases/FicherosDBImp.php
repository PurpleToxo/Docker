<?php
class FicherosDBImp implements FicherosDBInt {
    function listaFicheros($id_tarea): array {
        // Implementación para listar ficheros de una tarea
        $conexion = conectaTareas();

        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $sql = "SELECT * FROM ficheros WHERE id_tarea = " . $id_tarea;
            $resultados = $conexion->query($sql);
            $tareas = [];
            while($row = $resultados->fetch_assoc()){
                $tareas[] = $row;
            }
            return $tareas;
        }   
    }

    function buscaFichero($id): Fichero {
        // Implementación para buscar un fichero por su ID
        $conexion = conectaTareas();

        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $sql = "SELECT * FROM ficheros WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("i", $id);

            $stmt->execute();
            $resultados = $stmt->get_result();
            if ($resultados->num_rows == 1){
                $row = $resultados->fetch_assoc();
                $fichero = new Fichero(
                    $row['nombre'],
                    $row['file'],
                    $row['descripcion'],
                );
                return $fichero;
            }else{
                return null;
            }
        }
    }

    function borraFichero($id): bool {
        // Implementación para borrar un fichero por su ID
            try{
        $conexion = conectaTareas();

        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $sql = "DELETE FROM ficheros WHERE id = " . $id;
            if ($conexion->query($sql)){
                return [true, 'Fichero borrado correctamente.'];
            }else{
                return [false, 'No se pudo borrar el fichero.'];
            } 
        } 
        }catch (mysqli_sql_exception $e){
            throw new DatabaseException($e->getMessage(), $e->getMethod(),$e->getSql(), $e->getCode());
        }finally{
            cerrarConexion($conexion);
        }
    }

    function nuevoFichero($fichero): bool {
        // Implementación para agregar un nuevo fichero
        try{
        $conexion = conectaTareas();
        
        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $stmt = $conexion->prepare("INSERT INTO ficheros (nombre, file, descripcion, id_tarea) VALUES (?,?,?,?)");
            $stmt->bind_param("sssi", $fichero->getNombre(), $fichero->getFile(), $fichero->getDescripcion(), $fichero->getTarea());

            $stmt->execute();

            return [true, 'Fichero creado correctamente.'];
        }
        }catch (mysqli_sql_exception $e){
            throw new DatabaseException($e->getMessage(), $e->getMethod(),$e->getSql(), $e->getCode());
        }finally{
            cerrarConexion($conexion);
        }
    }
}
?>