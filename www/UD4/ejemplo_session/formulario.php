<?php
session_start();

// Generar la marca de sesión si no existe aún
if (!isset($_SESSION['session_token'])) {
    $_SESSION['session_token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['session_token'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de login</title>
</head>
<body>
    <h1>Ejemplo de login con marca de sesión</h1>
    <form action="logIn.php" method="post">
        <label>
            Usuario:<br>
            <input type="text" name="user" required>
        </label>
        <br><br>
        <label>
            Contraseña:<br>
            <input type="password" name="password" required>
        </label>
        <br><br>
        <input type="hidden" name="session_token" value="<?php echo htmlspecialchars($token, ENT_QUOTES, 'UTF-8'); ?>">
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
