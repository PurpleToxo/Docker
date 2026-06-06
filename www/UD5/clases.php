<?php

class Fruta extends Producto implements Precio {
    use Vendible;
    private $nombre, $color;
    public function __construct($nombre,$color, $tipo){
        parent::__construct($tipo);
        $this->nombre=$nombre;
        $this->color=$color;
    }


    public function getNombre(){
        return $this->nombre;
    }
    public function getColor(){
        return $this->color;
    }
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function setColor ($color){
        $this->color = $color;
    }


    public function getPrecio(){
        return $this->precio;
    }

}


?>