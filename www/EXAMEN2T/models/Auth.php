<?php
// models/Auth.php
// Gestiona toda la lógica de autenticación y autorización

class Auth {
    private static $usuarios = null;
    
    /**
     * Inicializa la lista de usuarios válidos
     */
    private static function initUsuarios() {

    }
    
    /**
     * IMPLEMENTAR POR EL ALUMNO
     * Crea un bucle que recorra el array de usuarios válidos self::$usuarios y compruebe que sus campos sean
     * los mismos que los parámetros que se les pasa a la función.
     * En caso correcto se deberá iniciar sesión y crear las variables de sesión usuario y rol.
     */
    public static function login($username, $password) {
    
        $admin=[
            'nombre'=>'deportista',
            'rol'=>'admin',
            'password'=>'nieve'
        ];
        $user=[
            'nombre'=>'espectador',
            'rol'=>'user',
            'password'=>'hielo'
        ];

        session_start();
        if ($_POST['username'] == $admin['nombre'] && $_POST['password']==$admin['password']){
            $_SESSION['usuario'] =$admin['nombre'];
            $_SESSION['rol'] = 'admin';
            return true;
        }elseif($_POST['username'] ==$user['nombre'] && $_POST['password']==$user['password']){
            $_SESSION['usuario'] = $user['nombre'];
            $_SESSION['rol'] = 'user';
            return true;
        }else{
            global $error;
            $error = "Usuario o contraseña incorrectos";
            return false;
        }
    }
    
    /**
     * IMPLEMENTAR POR EL ALUMNO
     * Verifica que haya una sesión activa.
     * Si no la hay, redirige al login.
     */
    public static function checkAuth() {
        if (!isset($_SESSION['user'])){
            header('Location: login.php');
        }
    }
    
    /**
     * IMPLEMENTAR POR EL ALUMNO
     * Verifica que el usuario sea administrador.
     * Si no lo es, redirige al inicio.
     */
    public static function checkAdmin() {
        if (!$_SESSION['rol']== 'admin'){
            header('Location: index.php');
        }
    }
    
    /**
     * IMPLEMENTAR POR EL ALUMNO
     * Cierra la sesión y redirige al login
     */
    public static function logout() {
        session_destroy();
        header('Location: login.php');   
    }
    
    /**
     * IMPLEMENTAR POR EL ALUMNO
     * Devuelve el nombre del usuario logueado
     */
    public static function getUsuarioActual() {
        if(session_status() === PHP_SESSION_ACTIVE){
            return "Usuario: " . $_SESSION['usuario'];
        }
    }
    
    /**
     * IMPLEMENTAR POR EL ALUMNO
     * Devuelve el rol del usuario logueado
     */
    public static function getRolActual() {
        if(session_status()===PHP_SESSION_ACTIVE){
            return "Rol: " . $_SESSION['rol'];
        }
        
    }
}
?>