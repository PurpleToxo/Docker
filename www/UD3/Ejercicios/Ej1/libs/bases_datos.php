<?php

function execute_query($connection, $sql){
    $result = $connection->query($sql);
    if($result == false){
        die ("Error procesing query: " . $connection->error);
    }
    return $result;
}

function connection(){
    $connection = new mysqli ('db', 'root','test');
    if ($connection->connect_errno != null){
        die("Ha fallao" . $connection->connect_error);
    }
    return $connection;
}

function create_DB($connection){
    $sql ="CREATE DATABASE IF NOT EXISTS tienda";
    $result = execute_query($connection,$sql); 
    return $result;
}

function select_DB($connection){
    $sql=" USE tienda";
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
    execute_query($sql);
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
    return $result;
}

function register_user($connection,$nombre,$apellido,$edad,$provincia){
    $sql="INSERT INTO USERS (nombre, apellidos, edad, provincia) VALUES ('$nombre', '$apellido', $edad, '$provincia')";
    $result = execute_query($connection,$sql); 
    return $result;
}

function delete_user($connection, $id_user){
    $sql="DELETE FROM USERS WHERE id_user=$id_user";
    $result = execute_query($connection,$sql); 
    return $result;
}

function close_connection($connection){
    $connection->close();
}
?>