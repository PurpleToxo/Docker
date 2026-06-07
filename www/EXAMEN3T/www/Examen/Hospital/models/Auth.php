<?php
// models/Auth.php

class Auth {
    private static $usuarios = null;
    
    private static function initUsuarios() {
        if (self::$usuarios == null) {
            self::$usuarios = array(
                new Usuario('david', 'maquinas', 'admin'),
                new Usuario('carlos', 'normal','usuario'),
                new Usuario('nicolas','arreglos','tecnico')
                /**
                 * --- EXAMEN ---
                 * IMPLEMENTAR POR EL ALUMNO.
                 * Añadir los usuarios que faltan
                 */
            );
        }
    }
    
    public static function login($username, $password) {
        self::initUsuarios();
        foreach (self::$usuarios as $usuario) {
            if ($usuario->getUsername() == $username && $usuario->verificarPassword($password)) {
                session_start();
                $_SESSION['usuario'] = $username;
                $_SESSION['rol'] = $usuario->getRol();
                return true;
            }
        }
        return false;
    }
    
    public static function checkAuth() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: login.php');
            exit;
        }
    }
    

    public static function checkAdmin() {
        self::checkAuth();
        if ($_SESSION['rol'] != 'admin') {
            header('Location: index.php');
            exit;
        }
    }
    
    public static function logout() {
        session_start();
        session_destroy();
        header('Location: login.php');
        exit;
    }
    
    public static function getUsuarioActual() {
        return isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
    }
    
    public static function getRolActual() {
        return isset($_SESSION['rol']) ? $_SESSION['rol'] : null;
    }
}
?>