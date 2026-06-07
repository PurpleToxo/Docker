<?php
// eliminar.php
require_once 'config/Database.php';
require_once 'models/Aparato.php';
require_once 'models/AparatoRepository.php';
require_once 'models/Usuario.php';
require_once 'models/Auth.php';

/**
 * --- EXAMEN ---
 * IMPLEMENTAR POR EL ALUMNO.
 * Pasos a seguir:
 * 1. Comprobar que el usuario haya iniciado sesión.
 * 2. Comprobar que el rol sea 'tecnico'.
 * 3. Recoger el id del aparato a eliminar.
 * 4. Llamar al método delete del repositorio con dicho id (antes crear una nueva instancia de la clase que contiene dicho método).
 * 5. Redirigir a la página principal.
 */
// ESCRIBIR AQUÍ TODA LA LÓGICA DE ELIMINAR.PHP
session_start();
if(!isset($_SESSION['usuario']) || $_SESSION['usuario']->getRol() !=='tecnico'){
    header('Location: index.php');
    exit;
}
if($_GET['id']){
    $id=$_GET['id'];
    $db=getConnection();
    $eliminar = new AparatoRepository();
    $eliminar->delete($id);
    header('Location: index.php');
    exit;
}

?>