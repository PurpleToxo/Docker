<?php
// models/Aparato.php

abstract class Aparato {
    protected $id;
    protected $nombre;
    protected $marca;
    protected $modelo;
    protected $numSerie;
    protected $planta;
    protected $habitacion;
    protected $fechaAdquisicion;
    protected $estado;
    
    public function __construct($nombre, $marca, $modelo, $numSerie, $planta, $habitacion, $fechaAdquisicion, $estado, $id = null) {
        $this->nombre = $nombre;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->numSerie = $numSerie;
        $this->planta = $planta;
        $this->habitacion = $habitacion;
        $this->fechaAdquisicion = $fechaAdquisicion;
        $this->estado = $estado;
        $this->id = $id;
    }
    
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getMarca() { return $this->marca; }
    public function getModelo() { return $this->modelo; }
    public function getNumSerie() { return $this->numSerie; }
    public function getPlanta() { return $this->planta; }
    public function getHabitacion() { return $this->habitacion; }
    public function getFechaAdquisicion() { return $this->fechaAdquisicion; }
    public function getEstado() { return $this->estado; }
    
    public function getUbicacionCompleta() {
        return "Planta " . $this->planta . " - " . $this->habitacion;
    }
    
    public function getAntiguedad() {
        $fechaAdq = new DateTime($this->fechaAdquisicion);
        $hoy = new DateTime();
        $diferencia = $hoy->diff($fechaAdq);
        return $diferencia->y;
    }
    
    abstract public function getTipoAparato();
    abstract public function necesitaSustitucion();
    
    /**
     * --- EXAMEN ---
     * IMPLEMENTAR POR EL ALUMNO en cada clase hija.
     * Devuelve true si el aparato cumple las condiciones para ser sustituido.
     */
}
?>