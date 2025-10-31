<?php

function get_conexion(){
    $conexion = new mysqli('db','root','test');
    if($conexion->connect_errno != null){
        die("Fallo en la conexion: ".$conexion->connect_error." con número ".$conexion->connect_errno);
    }
    return $conexion;
}

function select_DB($conexion,$nombre){
    return $conexion ->select_db($nombre);
}

function ejecutar_consulta($conexion, $sql){
    $sql = "Create database if not exist ".$nombre;
    ejecutar_consulta($conexion, $sql);
}

function create_table_user($conexion){

}
