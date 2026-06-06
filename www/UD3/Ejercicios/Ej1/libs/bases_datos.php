<?php

/* function execute_query($connection, $sql){
    $result = $connection->query($sql);
    if($result == false){
        die ("Error al procesar la petición: " . $connection->error);
    }
    return $result;
}

function get_conexion(){
    $connection = new mysqli ('db', 'root','test');
    if ($connection->connect_errno != null){
        die("Ha fallado la conexión" . $connection->connect_error);
    }
    return $connection;
}

function create_DB($connection){
    $sql ="CREATE DATABASE IF NOT EXISTS tienda";
    $result = execute_query($connection,$sql); 
    return $result;
}

function select_DB($connection){
    $sql="USE tienda";
    $result = execute_query($connection,$sql); 
    return $result;
}

function create_user_table($connection){
    $sql="CREATE TABLE IF NOT EXISTS USERS(
    id_user INT (6) auto_increment primary key,
    nombre varchar(50) not null,
    apellidos varchar(100) not null,
    edad int (3) not null,
    provincia varchar(50) not null
    )";
    execute_query($connection,$sql);
}

function list_users($connection){
    $sql="SELECT * FROM  USERS";
    $result = execute_query($connection,$sql); 
    return $result;
}

function get_user($connection, $id_user){
    $sql="SELECT * FROM USERS WHERE id_user=$id_user";
    $result = execute_query($connection,$sql); 
    return $result;
}

function edit_user($connection, $id_user,$nombre,$apellido,$edad,$provincia){
    $sql="UPDATE USERS SET nombre='$nombre', apellidos='$apellido', edad=$edad, provincia='$provincia' WHERE id_user=$id_user";
    $result = execute_query($connection,$sql); 
}

function register_user($connection,$nombre,$apellido,$edad,$provincia){
    $sql="INSERT INTO USERS (nombre, apellidos, edad, provincia) VALUES ('$nombre', '$apellido', $edad, '$provincia')";
    $result = execute_query($connection,$sql); 
}

function delete_user($connection, $id_user){
    $sql="DELETE FROM USERS WHERE id_user=$id_user";
    $result = execute_query($connection,$sql); 
}

function close_connection($connection){
    $connection->close();
} */

function executeQuery($conn,$sql){
    $stmt = $conn->query($sql);
    if($stmt === false){
        echo "Error al procesar consulta: " . $conn->error;
    }
    return $stmt;
}

function getConn(){
    $conn = new mysqli("db","user","test");
    if($conn->connect_errno){
        echo "Error con la conexión: " . $conn->error;
    }
    return $conn;
}

function create_DB($conn){
    $sql="CREATE DATABASE IF NOT EXISTS tienda";
    executeQuery($conn,$sql);
}
function select_DB($conn){
    $sql="USE tienda";
    executeQuery($conn,$sql);
}
function create_table_users($conn){
    $sql="CREATE TABLE IF NOT EXISTS users(
        id_user INT(6) AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR (200) not null,
        apellidos VARCHAR(200) not null,
        edad INT (2) not not null,
        provincia VARCHAR (200) not null
        )";
    executeQuery($conn,$sql);
}
function insert_users($conn,$nombre,$apellidos,$edad,$provincia){
    $sql="INSERT INTO users (nombre,apellidos,edad,provincia) VALUES ('$nombre','$apellidos','$edad','$provincia')";
    executeQuery($conn,$sql);
}
function delete_users($conn,$id){
    $sql="DELETE FROM users WHERE id=$id";
    executeQuery($conn,$sql);
}
function select_all_users($conn){
    $sql="SELECT * FROM users";
    $stmt = executeQuery($conn,$sql);
    return $stmt->fetch_all(MYSQLI_ASSOC);
}
function select_user($conn,$id){
    $sql = "SELECT * FROM users WHERE id=$id";
    $Stmt = executeQuery($conn,$sql);
    return $stmt->fetch_all(MYSQLI_ASSOC);
}
function upadte_users($conn,$id,$nombre,$apellidos,$edad,$provincia){
    $sql="UPDATE users SET nombre='$nombre',apellidos='$apellidos',edad='$edad',provincia='$provincia' WHERE id=$id";
    executeQuery($conn,$sql);
}
function close_conn($conn){
    $conn->close();
}



?>