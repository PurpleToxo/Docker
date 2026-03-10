<?php
class Tarea{
    private $id, $titulo, $descripcion, $estado, $id_usuario;

    //setters & getters
    function setId($id){
        $this->id=$id;
    }
    function getId(){
        return $this->id;
    }
    function setTitulo($titulo){
        $this->titulo=$titulo;
    }
    function getTitulo(){
        return $this->titulo;
    }
    function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
    }
    function getDescripcion(){
        return $this->descripcion;
    }
    function setEstado($estado){
        $this->estado=$estado;
    }
    function getEstado(){
        return $this->estado;
    }
    function setIdUsuario($id_usuario){
        $this->id_usuario=$id_usuario;
    }
    function getIdUsuario(){
        return $this->id_usuario;
    }
    function __construct($titulo, $descripcion, $estado, $id_usuario){
        $this->titulo=$titulo;
        $this->descripcion=$descripcion;
        $this->estado=$estado;
        $this->id_usuario=$id_usuario;
    }



}   