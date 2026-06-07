<?php
// models/Desfibrilador.php

class Desfibrilador extends Aparato {
    private $energiaMaxima;
    
    public function __construct($nombre, $marca, $modelo, $numSerie, $planta, $habitacion, $fechaAdquisicion, $estado, $energiaMaxima, $id = null) {
        parent::__construct($nombre, $marca, $modelo, $numSerie, $planta, $habitacion, $fechaAdquisicion, $estado, $id);
        $this->energiaMaxima = $energiaMaxima;
    }
    
    public function getEnergiaMaxima() { return $this->energiaMaxima; }
    
    public function getTipoAparato() { return 'desfibrilador'; }
    
    /**
     * --- EXAMEN ---
     * IMPLEMENTAR POR EL ALUMNO.
     * Un desfibrilador debe sustituirse si tiene más de 20 años Y está en la planta 2.
     */
    public function necesitaSustitucion(){
        $fechaAD = self::fechaAdquisicion;
        $fechaActual = new Date();
        $diferencia = $fechaActual -> diff($fechaAD);
        if ($diferencia->y >20 && $this->planta ==2){
            return true;
        }
        return false;
    }
    
}
?>