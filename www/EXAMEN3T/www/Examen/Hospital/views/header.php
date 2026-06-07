<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hospital - Gestión de Aparatos</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; padding: 20px; }
        .container { max-width: 1100px; margin: 0 auto; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #1e3a8a; color: white; }
        tr:hover { background: #f9fafb; }
        .btn { display: inline-block; padding: 6px 14px; background: #1e3a8a; color: white; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; font-size: 0.9em; }
        .btn-danger { background: #dc2626; }
        .btn-warning { background: #d97706; }
        .btn-success { background: #059669; }
        .form-group { margin-bottom: 12px; }
        label { display: block; margin-bottom: 4px; font-weight: bold; font-size: 0.9em; }
        input, select { padding: 6px; border: 1px solid #d1d5db; border-radius: 4px; }
        .alerta { background: #fee2e2; border-left: 4px solid #dc2626; padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        .alerta h3 { color: #991b1b; margin-top: 0; margin-bottom: 10px; }
        .tag { display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 0.8em; font-weight: bold; }
        .tag-op { background: #d1fae5; color: #065f46; }
        .tag-man { background: #fef3c7; color: #92400e; }
        .tag-fuera { background: #fee2e2; color: #991b1b; }
        .nav { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: white; padding: 15px 20px; border-radius: 8px; }
        .nav a { margin-left: 15px; color: #1e3a8a; text-decoration: none; font-size: 0.9em; }
        .nav a:hover { text-decoration: underline; }
        .info-user { color: #4b5563; font-size: 0.85em; }
        h2 { color: #1e3a8a; margin-top: 0; }
        .filtros { display: flex; gap: 10px; align-items: flex-end; flex-wrap: wrap; }
        .filtros .form-group { margin-bottom: 0; }
        .sustitucion-row { background: #fef2f2 !important; }
    </style>
</head>
<body>
<div class="container">
    <div class="nav">
        <h1 style="margin:0; font-size: 1.3em;">🏥 Gestión Hospitalaria</h1>
        <div>
            <?php if (isset($_SESSION['usuario'])): ?>
                <span class="info-user">👤 <?php echo $_SESSION['usuario']; ?> (<?php echo $_SESSION['rol']; ?>)</span>
                <a href="index.php">Inicio</a>
                <?php if ($_SESSION['rol'] == 'admin'): ?>
                    <a href="editar.php">Nuevo Aparato</a>
                <?php endif; ?>
                <a href="logout.php">Salir</a>
            <?php endif; ?>
        </div>
    </div>