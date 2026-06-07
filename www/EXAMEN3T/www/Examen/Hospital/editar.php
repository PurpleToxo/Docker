<?php
// editar.php
require_once 'config/Database.php';
require_once 'models/Aparato.php';
require_once 'models/Desfibrilador.php';
require_once 'models/MaquinaRayosX.php';
require_once 'models/Respirador.php';
require_once 'models/AparatoRepository.php';
require_once 'models/Usuario.php';
require_once 'models/Auth.php';

/**
 * --- EXAMEN ---
 * IMPLEMENTAR POR EL ALUMNO.
 * Proteger esta página para que únicamente pueda acceder el administrador.
 */
// ESCRIBIR AQUÍ LA PROTECCIÓN
session_start();
if(!isset($_SESSION['usuario']) || $_SESSION['usuario']->getRol() != 'admin'){
    header('Location: index.php');
    exit;
}

$repo = new AparatoRepository();
$mensaje = '';
$aparato = null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $aparato = $repo->findById($_POST['id']);
    if ($aparato) {
        $tipo = $aparato->getTipoAparato();
        $nuevo = null;
        
        if ($tipo == 'desfibrilador') {
            $nuevo = new Desfibrilador(
                $_POST['nombre'], $_POST['marca'], $_POST['modelo'], $_POST['num_serie'],
                $_POST['planta'], $_POST['habitacion'], $_POST['fecha_adquisicion'],
                $_POST['estado'], $aparato->getEnergiaMaxima(), $_POST['id']
            );
        } elseif ($tipo == 'rayosx') {
            $nuevo = new MaquinaRayosX(
                $_POST['nombre'], $_POST['marca'], $_POST['modelo'], $_POST['num_serie'],
                $_POST['planta'], $_POST['habitacion'], $_POST['fecha_adquisicion'],
                $_POST['estado'], $aparato->getPotenciaKv(), $_POST['id']
            );
        } elseif ($tipo == 'respirador') {
            $nuevo = new Respirador(
                $_POST['nombre'], $_POST['marca'], $_POST['modelo'], $_POST['num_serie'],
                $_POST['planta'], $_POST['habitacion'], $_POST['fecha_adquisicion'],
                $_POST['estado'], $aparato->getModoVentilacion(), $_POST['id']
            );
        }
        
        if ($nuevo) {
            $repo->save($nuevo);
            $mensaje = "Aparato actualizado correctamente";
            $aparato = $nuevo;
        }
    }
} else {
    if ($id) {
        $aparato = $repo->findById($id);
    }
}

if (!$aparato && $id) {
    header('Location: index.php');
    exit;
}

include 'views/header.php';
?>

<h2><?php echo $aparato ? 'Editar Aparato' : 'Nuevo Aparato'; ?></h2>

<?php if ($mensaje): ?>
<div class="card" style="background: #d1fae5;"><?php echo $mensaje; ?></div>
<?php endif; ?>

<?php if ($aparato): ?>
<form method="POST" class="card">
    <input type="hidden" name="id" value="<?php echo $aparato->getId(); ?>">
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php echo $aparato->getNombre(); ?>" required>
        </div>
        <div class="form-group">
            <label>Marca</label>
            <input type="text" name="marca" value="<?php echo $aparato->getMarca(); ?>" required>
        </div>
        <div class="form-group">
            <label>Modelo</label>
            <input type="text" name="modelo" value="<?php echo $aparato->getModelo(); ?>" required>
        </div>
        <div class="form-group">
            <label>Nº Serie</label>
            <input type="number" name="num_serie" value="<?php echo $aparato->getNumSerie(); ?>" required>
        </div>
        <div class="form-group">
            <label>Planta</label>
            <select name="planta" required>
                <option value="0" <?php if($aparato->getPlanta()=='0') echo 'selected'; ?>>Planta 0</option>
                <option value="1" <?php if($aparato->getPlanta()=='1') echo 'selected'; ?>>Planta 1</option>
                <option value="2" <?php if($aparato->getPlanta()=='2') echo 'selected'; ?>>Planta 2</option>
            </select>
        </div>
        <div class="form-group">
            <label>Habitación</label>
            <input type="text" name="habitacion" value="<?php echo $aparato->getHabitacion(); ?>" required>
        </div>
        <div class="form-group">
            <label>Fecha Adquisición</label>
            <input type="date" name="fecha_adquisicion" value="<?php echo $aparato->getFechaAdquisicion(); ?>" required>
        </div>
        <div class="form-group">
            <label>Estado</label>
            <select name="estado" required>
                <option value="Operativo" <?php if($aparato->getEstado()=='Operativo') echo 'selected'; ?>>Operativo</option>
                <option value="Mantenimiento" <?php if($aparato->getEstado()=='Mantenimiento') echo 'selected'; ?>>Mantenimiento</option>
                <option value="Fuera de servicio" <?php if($aparato->getEstado()=='Fuera de servicio') echo 'selected'; ?>>Fuera de servicio</option>
            </select>
        </div>
    </div>
    
    <div style="margin-top: 15px;">
        <button type="submit" class="btn">Guardar</button>
        <a href="index.php" class="btn" style="background:#6b7280;">Cancelar</a>
    </div>
</form>
<?php else: ?>
<p>Formulario de alta simplificado para el examen.</p>
<?php endif; ?>

<?php include 'views/footer.php'; ?>