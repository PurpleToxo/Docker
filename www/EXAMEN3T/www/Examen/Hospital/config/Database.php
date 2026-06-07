<?php
// config/Database.php

class Database {
    private static $instance = null;
    private static $conn = null;
    
    private static $servername = "db";
    private static $username = "root";
    private static $password = "test";
    private static $dbname = "Xes_Aldea_Moreira"; //nombre y apellidos
    
    private function __construct() {
        try {
            self::$conn = new PDO("mysql:host=" . self::$servername, self::$username, self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sql = "CREATE DATABASE IF NOT EXISTS " . self::$dbname;
            self::$conn->exec($sql);
            
            self::$conn = new PDO("mysql:host=" . self::$servername . ";dbname=" . self::$dbname, self::$username, self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $this->createTable();
            
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage() . "<br>";
        }
    }
    
    public static function getConnection() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$conn;
    }
    
    public static function close() {
        self::$conn = null;
        self::$instance = null;
    }
    
    private function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS aparatos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            marca VARCHAR(100) NOT NULL,
            modelo VARCHAR(100) NOT NULL,
            num_serie INT NOT NULL,
            planta VARCHAR(20) NOT NULL,
            habitacion VARCHAR(50) NOT NULL,
            fecha_adquisicion DATE NOT NULL,
            estado VARCHAR(50) NOT NULL DEFAULT 'Operativo',
            tipo_aparato VARCHAR(50) NOT NULL,
            energia_maxima INT,
            potencia_kv INT,
            modo_ventilacion VARCHAR(100)
        )";
        self::$conn->exec($sql);
        
        $result = self::$conn->query("SELECT COUNT(*) FROM aparatos");
        if ($result->fetchColumn() == 0) {
            $this->insertSampleData();
        }
    }
    
    private function insertSampleData() {
        $sql = "INSERT INTO aparatos 
            (nombre, marca, modelo, num_serie, planta, habitacion, fecha_adquisicion, estado, tipo_aparato, energia_maxima, potencia_kv, modo_ventilacion) 
            VALUES 
            ('Desfibrilador Bifásico', 'Zoll', 'R Series', 10001, '2', 'UCI-5', '1998-06-15', 'Operativo', 'desfibrilador', 200, NULL, NULL),
            ('Desfibrilador Manual', 'Physio-Control', 'Lifepak 20', 10002, '2', 'UCI-3', '2001-03-10', 'Operativo', 'desfibrilador', 360, NULL, NULL),
            ('Desfibrilador Portátil', 'Philips', 'HeartStart', 10003, '1', 'Box 12', '2020-08-01', 'Operativo', 'desfibrilador', 150, NULL, NULL),
            ('Máquina Rayos X Digital', 'Siemens', 'Ysio Max', 8000, '0', 'Rad-1', '2018-05-20', 'Operativo', 'rayosx', NULL, 150, NULL),
            ('Máquina Rayos X Portátil', 'Fujifilm', 'FDR Go', 12000, '1', 'Box 5', '2022-01-15', 'Operativo', 'rayosx', NULL, 120, NULL),
            ('Máquina Rayos X Convencional', 'GE Healthcare', 'Proteus', 4500, '0', 'Rad-2', '2015-11-30', 'Mantenimiento', 'rayosx', NULL, 100, NULL),
            ('Respirador Mecánico', 'Dräger', 'Evita V500', 20001, '2', 'UCI-1', '2005-09-01', 'Operativo', 'respirador', NULL, NULL, 'Volumen Controlado'),
            ('Respirador de Transporte', 'Hamilton', 'T1', 20002, '1', 'Urgencias', '2021-04-10', 'Operativo', 'respirador', NULL, NULL, 'PSV'),
            ('Respirador Neonatal', 'Maquet', 'Servo-n', 20003, '0', 'Neonatos', '2003-12-20', 'Fuera de servicio', 'respirador', NULL, NULL, 'CPAP')";
        
        self::$conn->exec($sql);
    }
}
?>