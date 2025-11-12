<?php 

function getConnection(){
    $servername='db';
    $username='root';
    $password='test';
    $dbname='donacion';

    try{
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username,$password);
        $connection -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo "Database connected successfully";
        return $connection;
    } catch (PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}

function exequteQuery($connection,$sql){
    try{
        $connection->query($sql);
    }catch(PDOExeption $e){
        echo $e->getMessage();
    }
}

function create_DB ($connection){
    $sql="CREATE DATABASE IF NOT EXISTS donacion";
    exequteQuery($connection,$sql);

}

function create_table_donantes($connection){

}

function create_table_historico($connection){

}

function create_table_admin($connection){

}

function register_donante(){

}

function list_donantes(){

}

function register_donation(){

}

function delete_donante(){

}

function list_donations(){

}

function search_donante(){

}