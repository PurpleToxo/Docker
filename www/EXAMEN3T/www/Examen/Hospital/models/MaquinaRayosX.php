<?php
// models/MaquinaRayosX.php

class MaquinaRayosX extends Aparato {
    private $potenciaKv;
    
    public function __construct($nombre, $marca, $modelo, $numSerie, $planta, $habitacion, $fechaAdquisicion, $estado, $potenciaKv, $id = null) {
        parent::__construct($nombre, $marca, $modelo, $numSerie, $planta, $habitacion, $fechaAdquisicion, $estado, $id);
        $this->potenciaKv = $potenciaKv;
    }
    
    public function getPotenciaKv() { return $this->potenciaKv; }
    
    public function getTipoAparato() { return 'rayosx'; }
    
    /**
     * --- EXAMEN ---
     * IMPLEMENTAR POR EL ALUMNO.
     * Una máquina de rayos X debe sustituirse si su número de serie es menor a 10000.
     */
    public function necesitaSustitucion(){
        if($this->numSerie<10000){
            return true;
        }
        return false;
    }
}
?>