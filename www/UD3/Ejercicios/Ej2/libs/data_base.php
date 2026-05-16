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

function create_DB ($connection){
    $sql="CREATE DATABASE IF NOT EXISTS DONACION";
    $stmt=$connection->prepare($sql);
    $stmt->execute();
}

function select_DB($connection){
    $sql="USE donacion";
    $stmt=$connection->prepare($sql);
    $stmt->execute();
}

function create_table_donantes($connection){
    $sql="CREATE TABLE IF NOT EXISTS DONANTES(
        id int (6) auto_increment primary key,
        nombre varchar (50) not null,
        apellidos varchar(100) not null,
        edad int (3) not null check (edad>=18),
        grp_sangre varchar (3) not null(check (grp_sangre in ('A+','A-','B+','B-','AB+','AB-','O+','O-'))),
        cod_postal int (5) not null,
        tlf int (9) not null
        )";
    executeQuery($connection,$sql);
}

function create_table_historico($connection){
    $sql="CREATE TABLE IF NOT EXISTS HISTORICO(
        id int (6) auto_increment primary key,
        id_donante int (6) not null,
        last_donation date  default current_date,
        next_donation date generate always as (last_donation + interval 4 months) stored,
        foreign key (id_donante) references DONANTES(id)
        )";
    executeQuery($connection,$sql);
}

function create_table_admin($connection){
    $sql ="CREATE TABLE IF NOT EXISTS ADMIN(
    name_admin varchar (50) primary key,
    password_admin varchar(200) not null
    )";
    executeQuery($connection,$sql);
}


function register_donante($connection,$nombre, $apellidos,$edad,$grp_sangre,$cod_postal,$tlf){
    $sql="INSERT INTO DONANTES(nombre,apellidos,edad,grp_sangre,cod_postal,tlf) VALUES(?,?,?,?,?,?)";
    $stmt=$connection->prepare($sql);
    $stmt->execute([$nombre,$apellido,$edad,$grp_sangre,$cod_postal,$tlf]);

}

function list_donantes($connecton){
    $sql="SELECT * FROM DONANTES";
    $stmt=$connecton->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function register_donation($connection,$id_donante){
    $sql="INSERT INTO HISTORICO(id_donante)VALUES(?)";
    $stmt=$connection->prepare($sql);
    $stmt->execute([$id_donante]);

}

function delete_donante($connection,$id){
    $sql="DELETE FROM DONANTES WHERE id=?";
    $stmt=$connection->prepare($sql);
    $stmt->execute([$id]);
}

function list_donations($connection,$id_donante){
    $sql="SELECT * FROM HISTORICO WHERE id_donante=?";
    $stmt=$connection->prepare($sql);
    $stmt->execute([$id_donante]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function search_donante($connection,$id){
    $sql="SELECT * FROM DONANTES WHERE id=?";
    $stmt=$connection->prepare($sql);
    $stmt-execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}