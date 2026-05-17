<?php
session_start();

function fail(string $message): void
{
    echo '<!DOCTYPE html>';
    echo '<html lang="es"><head><meta charset="UTF-8"><title>Error</title></head><body>';
    echo '<h1>Error de autenticación</h1>';
    echo '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
    echo '<p><a href="formulario.php">Volver al formulario</a></p>';
    echo '</body></html>';
    exit;
}

// Comprobar que la marca existe en la sesión y se envió desde el formulario
if (!isset($_SESSION['session_token'], $_POST['session_token'])) {
    fail('Falta la marca de sesión.');
}

if (!hash_equals($_SESSION['session_token'], $_POST['session_token'])) {
    fail('Marca de sesión inválida.');
}

$user = $_POST['user'] ?? '';
$pass = $_POST['password'] ?? '';

// Usuario y contraseña de ejemplo
$validUser = 'admin';
$validPass = '1234';

if ($user !== $validUser || $pass !== $validPass) {
    fail('Usuario o contraseña incorrectos.');
}

// Regenerar el ID de sesión tras login para mayor seguridad
session_regenerate_id(true);

$_SESSION['authenticated'] = true;
$_SESSION['user'] = $user;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login correcto</title>
</head>
<body>
    <h1>Login correcto</h1>
    <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8'); ?>.</p>
    <p>La marca de sesión se verificó correctamente y el ID de sesión se regeneró.</p>
    <p><a href="formulario.php">Volver</a></p>
</body>
</html>
