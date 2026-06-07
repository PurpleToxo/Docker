<?php
// models/AparatoRepository.php

class AparatoRepository {
    private $conn;
    
    public function __construct() {
        $this->conn = Database::getConnection();
    }
    
    public function findAll($filtros = array()) {
        $sql = "SELECT * FROM aparatos WHERE 1=1";
        $params = array();
        
        if (!empty($filtros['tipo'])) {
            $sql .= " AND tipo_aparato = ?";
            $params[] = $filtros['tipo'];
        }
        if (!empty($filtros['planta'])) {
            $sql .= " AND planta = ?";
            $params[] = $filtros['planta'];
        }
    }
        /**
         * --- EXAMEN ---
         * IMPLEMENTAR POR EL ALUMNO.
         * Si se recibe el filtro 'planta', añadir la sentencia sql necesaria 
         */
        // ESCRIBIR AQUÍ EL FILTRO POR PLANTA
    
    public function findById($id) {
        $sql = "SELECT * FROM aparatos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array($id));
        $row = $stmt->fetch();
        
        if ($row) {
            return $this->crearDesdeFila($row);
        }
        return null;
    }
    
    public function save($aparato) {
        if ($aparato->getId()) {
            return $this->update($aparato);
        } else {
            return $this->insert($aparato);
        }
    }
    
    private function insert($aparato) {
        $sql = "INSERT INTO aparatos 
                (nombre, marca, modelo, num_serie, planta, habitacion, fecha_adquisicion, estado, tipo_aparato, energia_maxima, potencia_kv, modo_ventilacion) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        
        $tipo = $aparato->getTipoAparato();
        $energia = null; $potencia = null; $modo = null;
        
        if ($tipo == 'desfibrilador') {
            $energia = $aparato->getEnergiaMaxima();
        } elseif ($tipo == 'rayosx') {
            $potencia = $aparato->getPotenciaKv();
        } elseif ($tipo == 'respirador') {
            $modo = $aparato->getModoVentilacion();
        }
        
        $stmt->execute(array(
            $aparato->getNombre(), $aparato->getMarca(), $aparato->getModelo(), $aparato->getNumSerie(),
            $aparato->getPlanta(), $aparato->getHabitacion(), $aparato->getFechaAdquisicion(),
            $aparato->getEstado(), $tipo, $energia, $potencia, $modo
        ));
        
        return $this->conn->lastInsertId();
    }
    
    private function update($aparato) {
        $sql = "UPDATE aparatos SET 
                nombre=?, marca=?, modelo=?, num_serie=?, planta=?, habitacion=?, 
                fecha_adquisicion=?, estado=? 
                WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(
            $aparato->getNombre(), $aparato->getMarca(), $aparato->getModelo(), $aparato->getNumSerie(),
            $aparato->getPlanta(), $aparato->getHabitacion(), $aparato->getFechaAdquisicion(),
            $aparato->getEstado(), $aparato->getId()
        ));
        return true;
    }
    
    /**
     * --- EXAMEN ---
     * IMPLEMENTAR POR EL ALUMNO.
     * Crear una función para eliminar el aparato cuyo id se recibe por parámetro.
     */
    public function delete ($id){
        $sql ="DELETE FROM aparatos WHERE id=$id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return true;
    }
    
    public function getTipos() {
        $sql = "SELECT DISTINCT tipo_aparato FROM aparatos ORDER BY tipo_aparato";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    public function getPlanta() {
        $sql = "SELECT DISTINCT planta FROM aparatos ORDER BY planta";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    private function crearDesdeFila($row) {
        if ($row['tipo_aparato'] == 'desfibrilador') {
            return new Desfibrilador(
                $row['nombre'], $row['marca'], $row['modelo'], $row['num_serie'], $row['planta'], $row['habitacion'],
                $row['fecha_adquisicion'], $row['estado'], $row['energia_maxima'], $row['id']
            );
        } elseif ($row['tipo_aparato'] == 'rayosx') {
            return new MaquinaRayosX(
                $row['nombre'], $row['marca'], $row['modelo'], $row['num_serie'], $row['planta'], $row['habitacion'],
                $row['fecha_adquisicion'], $row['estado'], $row['potencia_kv'], $row['id']
            );
        } elseif ($row['tipo_aparato'] == 'respirador') {
            return new Respirador(
                $row['nombre'], $row['marca'], $row['modelo'], $row['num_serie'], $row['planta'], $row['habitacion'],
                $row['fecha_adquisicion'], $row['estado'], $row['modo_ventilacion'], $row['id']
            );
        }
        return null;
    }
    
    public function __destruct() {
        Database::close();
    }
}
?>