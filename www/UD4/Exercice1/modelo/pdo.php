<?php

function conectaPDO(){
    $servername = $_ENV['DATABASE_HOST'];
    $username = $_ENV['DATABASE_USER'];
    $password = $_ENV['DATABASE_PASSWORD'];
    $dbname = $_ENV['DATABASE_NAME'];

    $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conPDO;
}

function listaUsuarios(){
    try {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT id, username, nombre, apellidos, rol FROM usuarios');
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultados = $stmt->fetchAll();
        return [true, $resultados];
    }catch (PDOException $e) {
        return [false, $e->getMessage()];
    }finally {
        $con = null;
    }
}

function listaTareasPDO($id_usuario, $estado){
    try {
        $con = conectaPDO();
        $sql = 'SELECT * FROM tareas WHERE id_usuario = ' . $id_usuario;
        if (isset($estado)){
            $sql = $sql . " AND estado = '" . $estado . "'";
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $tareas = array();
        while ($row = $stmt->fetch()){
            $usuario = buscaUsuario($row['id_usuario']);
            $row['id_usuario'] = $usuario['username'];
            array_push($tareas, $row);
        }
        return [true, $tareas];
    }catch (PDOException $e) {
        return [false, $e->getMessage()];
    }finally {
        $con = null;
    }
}

function nuevoUsuario(User $user){
    try{
        $con = conectaPDO();
        $stmt = $con->prepare("INSERT INTO usuarios (nombre, apellidos, username, contrasena, rol) VALUES (:nombre, :apellidos, :username, :contrasena, :rol)");
        $stmt->bindParam(':nombre', $user->getName());
        $stmt->bindParam(':apellidos', $user->getApellidos());
        $stmt->bindParam(':username', $user->getUsername());
        $stmt->bindParam(':contrasena', $user->getContrasena());
        $stmt->bindParam(':rol',$user->getRol());
        $stmt->execute();
        
        $stmt->closeCursor();

        return [true, null];
    }catch (PDOException $e){
        return [false, $e->getMessage()];
    }finally{
        $con = null;
    }
}

function actualizaUsuario(User $user){
    try{
        $con = conectaPDO();
        $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, username = :username, rol = :rol";

        if ($user->getContasena()!=null && $user->getContasena()!=''){
            $sql = $sql . ', contrasena = :contrasena';
        }

        $sql = $sql . ' WHERE id = :id';

        $stmt = $con->prepare($sql);
        $stmt->bindParam(':nombre', $user->getName());
        $stmt->bindParam(':apellidos', $user->getApellidos());
        $stmt->bindParam(':username', $user->getUsername());
        $stmt->bindParam(':rol',$user->getRol());
        if ($user->getContrasena()!=null && $user->getContrasena()!='') {
            $stmt->bindParam(':contrasena', $user->getContrasena());
        }
        $stmt->bindParam(':id', $user->getId());

        $stmt->execute();
        
        $stmt->closeCursor();

        return [true, null];
    }catch (PDOException $e){
        return [false, $e->getMessage()];
    }finally{
        $con = null;
    }
}

function borraUsuario(User $user){
    try {
        $con = conectaPDO();

        $con->beginTransaction();

        $stmt = $con->prepare('DELETE FROM tareas WHERE id_usuario = ' . $user->getId());
        $stmt->execute();
        $stmt = $con->prepare('DELETE FROM usuarios WHERE id = ' . $user->getId());
        $stmt->execute();
        
        return [$con->commit(), ''];
    }catch (PDOException $e){
        return [false, $e->getMessage()];
    }finally{
        $con = null;
    }
}

function buscaUsuario(User $user): ?User{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT * FROM usuarios WHERE id = ' . $user->getId());
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User($row['nombre'], $row['apellidos'], $row['username'], $row['contrasena'], $row['rol'], $row['id']);
        }
    }catch (PDOException $e){
        return null;
    }finally{
        $con = null;
    }
}
function buscaUsuarioPorNombre(User $user): ?User{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT * FROM usuarios WHERE nombre = ' . $user->getName() . ' AND contrasena = ' . $user->getContrasena());
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row){
            return new User($row['nombre'],$row['apellidos'],$row['username'],$row['contrasena'],$row['rol'],$row['id']);
        }
    }catch (PDOException $e){
        return null;
    }finally{
        $con = null;
    }
}