<?php

trait Vendible {
    public function vender(){
        return "Vendiendo " . $this->getNombre() . " a " . $this->getPrecio() . " euros.";
    }
}

?>