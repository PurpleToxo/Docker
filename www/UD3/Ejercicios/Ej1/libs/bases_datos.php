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

function execute_query($conn, $sql){
    $result = $conn->query($sql);
    if ($result==false){
        die("fallando");
    }
    return $result;

}
function getConnection(){
    $conn = new mysqli ('db','root','test');
    if ($conn->connect_errno!==0){
        die ("fallando");
    }
    return $conn;
}
function create_DB ($conn){
    $sql = 'CREATE DATABASE IF NOT EXISTS tienda';
    execute_query($conn,$sql);
}
function select_DB($conn){
    $sql = 'USE tienda';
    execute_query($conn,$sql);

}
function create_table($conn){
    $sql="CREATE TABLE IF NOT EXISTS users(
    id_user INT (6) Primary Key auto_increment,
    nombre varchar(100) not null,
    apellidos varchar(200) not null,
    edad INT (3) not null,
    provincia varchar(100) not null
    )";
    execute_query($conn,$sql);
}
function select ($conn){
    $sql="SELECT * FROM users";
    $result = execute_query($conn,$sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
function insert ($conn, $nombre,$apellido,$edad,$provincia){
    $sql ="INSERT INTO users (nombre,apellido,edad,provincia) VALUES('$nombre','$apellido',$edad,'$provincia')";
    $result = execute_query($conn,$sql);
    return $result;
}
function delete ($conn,$id){
    $sql = "DELETE FROM users WHERE id_user=$id";
    $result = execute_query($conn,$sql);
    return $result;
}
function update($conn, $nombre,$apellido,$edad,$provincia, $id){
    $sql = "UPDATE users SET nombre='$nombre', apellido='$apellido', edad=$edad, provincia='$provincia' WHERE id_user=$id";
    $result = execute_query($conn,$sql);
    return $result;
}
?>