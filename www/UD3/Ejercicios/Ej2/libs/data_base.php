<?php 

function getConnection(){
    $servername='db';
    $username='root';
    $password='test';
    $dbname='donacion';

    try{
        $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username,$password);
        $conPDO -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo "Database connected successfully";
        return $conPDO;
    } catch (PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
}
function create_DB (){

}

function create_table_donantes($conection){

}

function create_table_historico($conection){

}

function create_table_admin($conection){

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