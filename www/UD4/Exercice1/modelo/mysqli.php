<?php

function conecta($host, $user, $pass, $db){
    $conexion = new mysqli($host, $user, $pass, $db);
    return $conexion;
}

function conectaTareas(){
    return conecta($_ENV['DATABASE_HOST'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD'], $_ENV['DATABASE_NAME']);
}

function cerrarConexion($conexion){
    if (isset($conexion) && $conexion->connect_errno === 0) {
        $conexion->close();
    }
}

function creaDB(){
    $conexion = null;
    try {
        $conexion = conecta($_ENV['DATABASE_HOST'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD'], null);
        
        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else {
            // Verificar si la base de datos ya existe
            $sqlCheck = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'tareas'";
            $resultado = $conexion->query($sqlCheck);
            if ($resultado && $resultado->num_rows > 0) {
                return [false, 'La base de datos "tareas" ya existía.'];
            }

            $sql = 'CREATE DATABASE IF NOT EXISTS tareas';
            if ($conexion->query($sql)){
                return [true, 'Base de datos "tareas" creada correctamente'];
            }else {
                return [false, 'No se pudo crear la base de datos "tareas".'];
            }
        }
    }catch (mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}

function createTablaUsuarios(){
    $conexion = null;
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            // Verificar si la tabla ya existe
            $sqlCheck = "SHOW TABLES LIKE 'usuarios'";
            $resultado = $conexion->query($sqlCheck);

            if ($resultado && $resultado->num_rows > 0){
                return [false, 'La tabla "usuarios" ya existía.'];
            }
            $sql = 'CREATE TABLE `usuarios` (`id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(50) NOT NULL , `nombre` VARCHAR(50) NOT NULL , `apellidos` VARCHAR(100) NOT NULL , `contrasena` VARCHAR(100) NOT NULL, `rol` INT NOT NULL DEFAULT 0, PRIMARY KEY (`id`)) ';
            if ($conexion->query($sql)){
                return [true, 'Tabla "usuarios" creada correctamente'];
            }else{
                return [false, 'No se pudo crear la tabla "usuarios".'];
            }
        }
    }catch (mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}

function createTablaTareas(){
    $conexion = null;
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            // Verificar si la tabla ya existe
            $sqlCheck = "SHOW TABLES LIKE 'tareas'";
            $resultado = $conexion->query($sqlCheck);

            if ($resultado && $resultado->num_rows > 0){
                return [false, 'La tabla "tareas" ya existía.'];
            }
            $sql = 'CREATE TABLE `tareas` (`id` INT NOT NULL AUTO_INCREMENT, `titulo` VARCHAR(50) NOT NULL, `descripcion` VARCHAR(250) NOT NULL, `estado` VARCHAR(50) NOT NULL, `id_usuario` INT NOT NULL, PRIMARY KEY (`id`), FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id`))';
            if ($conexion->query($sql)) {
                return [true, 'Tabla "tareas" creada correctamente'];
            }else{
                return [false, 'No se pudo crear la tabla "tareas".'];
            }
        }
    }catch (mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}
function createTablaFichero(){
    $conexion =null;
    try{
        $conexion = conectaTareas();
        if($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $sqlCheck ="SHOW TABLES LIKE 'ficheros'";
            $resultado = $conexion ->query($sqlCheck);
            if ($resultado &&$resultado ->num_rows >0){
                return[false, 'La tabla "ficheros" ya existia.'];
            }
            $sql = 'CREATE TABLE `ficheros` (`id` INT NOT NULL AUTO_INCREMENT, `nombre` VARCHAR(100) NOT NULL,`file` VARCHAR(250) NOT NULL, `descripcion` VARCHAR(250) NOT NULL, `id_tarea` INT,  PRIMARY KEY (`id`), FOREIGN KEY (`id_tarea`) REFERENCES `tareas`(`id`))';
            if($conexion->query($sql)){
                return[true,'Tabla creada correctamente.'];
            }else{
                return[false,'No se pudo crear la tabla "ficheros".'];
            }
        }
    }catch(mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}
function listarFich(Fichero $fichero){
    $conexion = conectaTareas();

    if ($conexion->connect_error){
        return [false, $conexion->error];
    }else{
        $sql = "SELECT * FROM ficheros WHERE id_tarea = " . $fichero->getTarea();
        $resultados = $conexion->query($sql);
        $tareas = [];
        while($row = $resultados->fetch_assoc()){
            $tareas[] = $row;
        }
        return $tareas;
    }    
}

function borrarFicheros(Fichero $fichero){
    try{
        $conexion = conectaTareas();

        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $sql = "DELETE FROM ficheros WHERE id = " . $fichero->getId();
            if ($conexion->query($sql)){
                return [true, 'Fichero borrado correctamente.'];
            }else{
                return [false, 'No se pudo borrar el fichero.'];
            } 
        } 
    }catch (mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}
function listaTareas(){
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $sql = "SELECT * FROM tareas";
            $resultados = $conexion->query($sql);
            $tareas = array();
            while ($row = $resultados->fetch_assoc()){
                $tarea = new Tarea(
                $row['titulo'],
                $row['descripcion'],
                $row['estado'],
                $row['id_usuario'],
                $row['id']
            );
            $tareas[] = $tarea;
            }
            return [true, $tareas];
        }
    }catch (mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}
function nuevoFichero(Fichero $fichero){
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
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}
function nuevaTarea(Tarea $tarea){
    try{
        $conexion = conectaTareas();
        
        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $stmt = $conexion->prepare("INSERT INTO tareas (titulo, descripcion, estado, id_usuario) VALUES (?,?,?,?)");
            $stmt->bind_param("sssi", $tarea->getTitulo(), $tarea->getDescripcion(), $tarea->getEstado(), $tarea->getIdUsuario());

            $stmt->execute();

            return [true, 'Tarea creada correctamente.'];
        }
    }catch (mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}

function actualizaTarea(Tarea $tarea){
    try{
        $conexion = conectaTareas();
        
        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $sql = "UPDATE tareas SET titulo = ?, descripcion = ?, estado = ?, id_usuario = ? WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("sssii", $tarea->getTitulo(), $tarea->getDescripcion(), $tarea->getEstado(), $tarea->getIdUsuario(), $tarea->getId());

            $stmt->execute();

            return [true, 'Tarea actualizada correctamente.'];
        }
    }catch (mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}

function borraTarea(Tarea $tarea){
    try{
        $conexion = conectaTareas();

        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $sql = "DELETE FROM tareas WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("i", $tarea->getId());

            $stmt->execute();
            if ($conexion->query($sql)){
                return [true, 'Tarea borrada correctamente.'];
            }else{
                return [false, 'No se pudo borrar la tarea.'];
            } 
        } 
    }catch (mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        cerrarConexion($conexion);
    }
}

function buscaTarea(Tarea $tarea){
    $conexion = conectaTareas();

    if ($conexion->connect_error){
        return [false, $conexion->error];
    }else{
        $sql = "DELETE FROM tareas WHERE id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $tarea->getId());

        $stmt->execute();
        $resultados = $stmt->get_result();
        if ($resultados->num_rows == 1){
            $row = $resultados->fetch_assoc();
            $tarea = new Tarea(
                $row['titulo'],
                $row['descripcion'],
                $row['estado'],
                $row['id_usuario'],
                $row['id']
            );
            return $tarea;
        }else{
            return null;
        }
    }
}

function buscaUsuarioMysqli(User $user){
    $conexion = conectaTareas();

    if ($conexion->connect_error){
        return [false, $conexion->error];
    }else{
        $sql = "SELECT * FROM usuarios WHERE id = " . $user->getId();
        $resultados = $conexion->query($sql);
        if ($resultados->num_rows == 1){
            return $resultados->fetch_assoc();
        }else{
            return null;
        }
    }
}