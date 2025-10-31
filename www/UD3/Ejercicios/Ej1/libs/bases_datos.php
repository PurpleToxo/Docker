<?php

function get_conexion(){
    $conexion = new mysqli('db','root','test');
    if($conexion->connect_errno != null){
        die("Fallo en la conexion: ".$conexion->connect_error." con número ".$conexion->connect_errno);
    }
    return $conexion;
}

function select_DB($conexion){
   return $conexion ->select_db("tienda");
}

function ejecutar_consulta($conexion, $sql){
    $sql = "Create database if not exist ".$nombre;
    ejecutar_consulta($conexion, $sql);
}

function create_table_user($conexion){
    $sql="CREATE TABLE IF NOT EXISTs USUARIOS(
    id INT (6) primary key auto_increment,
    nombre varchar (50) not null, 
    apellidos varchar(100) not null,
    edad int(3) not null,
    provincia varchar(20) not null
    )";

    $conexion->query($sql);
}
