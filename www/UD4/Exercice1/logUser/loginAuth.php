<?php
/**
 * 0 solo a las tareas que coincidan con usuario
 * 1 puede acceder a todo
 */
$usuario = $_POST['usuario'];
$contrasena = $_POST['constrasena'];

if (!isset($usuario) || !isset($contrasena)) throw new Exception("Usuario no encontrado");

required_once('../modelo/pdo.php');
$usuarioEncontrado = buscaUsuarioPorNombre($usuario, $contrasena);
if ($usuarioEncontrado){
    $rol = $usuarioEncontrado['rol'];
    $id = $usuarioEncontrado['id'];
    session_start();
    $_SESSION['usuario'] = $id;
    $_SESSION['rol']=$rol;
    header('Location: ../index.php');
    exit;
}

?>