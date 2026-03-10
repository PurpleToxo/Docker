<?php
class Fichero{
    private $id, $nombre, $file, $descripcion, $tarea;
    const MAX_SIZE=20 *1024 *1024;
    const FORMATOS=["image/jpg", "image/png", "application/pdf"];


    //setters & getters
    function setId($id){
        $this->id=$id;
    }
    function getId(){
        return $this->id;
    }
    function setNombre($nombre){
        $this->nombre=$nombre;
    }
    function getNombre(){
        return $this->nombre;
    }
    function setFile($file){
        $this->file=$file;
    }
    function getFile(){
        return $this->file;
    }
    function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
    }
    function getDescripcion(){
        return $this->descripcion;
    }
    function setTarea($tarea){
        $this->tarea=$tarea;
    }
    function getTarea(){
        return $this->tarea;
    }
    function __construct($nombre, $file, $descripcion,$tarea){
        $this->nombre=$nombre;
        $this->file=$file;
        $this->descripcion=$descripcion;
        $this->tarea=$tarea;
    }

    //validar los datos
    static function validarInfo($fichero, $archivo){
        $errores=[];
        if(empty($fichero->getNombre())){
            $errores["nombre"]="El nombre no puede estar vacío.";
        }
        if(empty($fichero->getDescripcion())){
            $errores['descripcion']="La descripción es obligatoria.";
        }
        if (empty($archivo['name'])){
            $errores['file']='Debe seleccionar un fichero.';
        }else{
            //validaciones del archivo
            if(!in_array($archivo['type'], self::FORMATOS)){
                $errores['file']='Este formato no está permitido.';
            }
            if($archivo['size']>self::MAX_SIZE){
                $errores['file']='El tamaño es demasiado grande.';
            }
        }
    }
}
?>