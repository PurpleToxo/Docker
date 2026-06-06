<?php
// models/Esquiador.php

class Esquiador extends Deportista {
    private $disciplina;
    private $tipoEsqui;
    
    public function __construct($nombre, $apellidos, $pais, $edad, $genero, $oro, $plata, $bronce, $disciplina, $tipoEsqui, $id = null) {
        parent::__construct($nombre, $apellidos, $pais, $edad, $genero, $oro, $plata, $bronce, $id);
        $this->disciplina = $disciplina;
        $this->tipoEsqui = $tipoEsqui;
    }
    
    public function getTipoDeporte() {
        return 'esqui';
    }
    
    public function getDetalles() {
        return array(
            'disciplina' => $this->disciplina,
            'tipo_esqui' => $this->tipoEsqui
        );
    }
    
    public function getDisciplina() { return $this->disciplina; }
    public function getTipoEsqui() { return $this->tipoEsqui; }
    
    
    function calcularPuntuacion(Deportista $deportista){
        $esqui=$deportista['tipo_deporte'];
        $oro= $deportista['medalla_oro'];
        $plata=$deportista['medalla_plata'];
        $bronce=$deportista['medalla_bronce'];
        if($esqui =='libre'){
            $puntuacion = $oro + $plata + $bronce;
            return $puntuacion * 60;
        }else{
            return $oro + $plata + $bronce;
        }
    }
}
?>