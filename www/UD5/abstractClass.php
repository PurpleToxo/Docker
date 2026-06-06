<?php 
abstract class Producto{
    protected $tipo;
    public function __construct($tipo){
        $this->tipo=$tipo;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public  function setTipo($tipo){
        $this->tipo=$tipo;
    }
    abstract public function mostrarTipo();
    
}