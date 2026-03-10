<?php
class User{
    private $id, $username, $name, $lastname, $password, $rol;


    //setters & getters
    
    function getId(){
        return $this->id;
    }
    function setUsername($username){
        $this->username = $username;
    }
    function getUsername(){
        return $this->name;
    }
    function setName($name){
        $this->name=$name;
    }
    function getName(){
        return $this->name;
    }
    function setApellidos($lastname){
        $this->lastname=$lastname;
    }
    function getApellidos(){
        return $this->lastname;
    }
    function setContasena($password){
        $this->password=$password;
    }
    function getContasena(){
        return $this->password;
    }
    function setRol($rol){
        $this->rol=$rol;
    }
    function getRol(){
        return $this->rol;
    }

    function __construct($username, $lastname, $password, $rol){
        $this->username=$username;
        $this->name=$name;
        $this->lastname=$lastname;
        $this->password=$password;
        $this->rol=$rol;
    }


}
?>