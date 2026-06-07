<?php
// models/Respirador.php

class Respirador extends Aparato {
    private $modoVentilacion;
    
    public function __construct($nombre, $marca, $modelo, $numSerie, $planta, $habitacion, $fechaAdquisicion, $estado, $modoVentilacion, $id = null) {
        parent::__construct($nombre, $marca, $modelo, $numSerie, $planta, $habitacion, $fechaAdquisicion, $estado, $id);
        $this->modoVentilacion = $modoVentilacion;
    }
    
    public function getModoVentilacion() { return $this->modoVentilacion; }
    
    public function getTipoAparato() { return 'respirador'; }
    
    /**
     * --- EXAMEN ---
     * IMPLEMENTAR POR EL ALUMNO.
     * Un respirador debe sustituirse si tiene más de 15 años.
     */
    public function necesitaSustitucion(){
        $fechaAD = $this->getFechaAdquisicion();
        $fechaActual = new Date();
        if($fechaActual-$fechaAD >15){
            return true;
        }
        return false;
    }

}
?>