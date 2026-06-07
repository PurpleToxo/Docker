<?php
// detalle.php
require_once 'config/Database.php';
require_once 'models/Aparato.php';
require_once 'models/Desfibrilador.php';
require_once 'models/MaquinaRayosX.php';
require_once 'models/Respirador.php';
require_once 'models/AparatoRepository.php';
require_once 'models/Usuario.php';
require_once 'models/Auth.php';
Auth::checkAuth();

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$repo = new AparatoRepository();
$aparato = $repo->findById($id);

if (!$aparato) {
    header('Location: index.php');
    exit;
}

include 'views/header.php';
?>

<div class="card">
    <h2><?php echo $aparato->getNombre(); ?></h2>
    
    <p><strong>Tipo:</strong> <?php echo ucfirst($aparato->getTipoAparato()); ?></p>
    <p><strong>Marca:</strong> <?php echo $aparato->getMarca(); ?></p>
    <p><strong>Modelo:</strong> <?php echo $aparato->getModelo(); ?></p>
    <p><strong>Nº Serie:</strong> <?php echo $aparato->getNumSerie(); ?></p>
    <p><strong>Ubicación:</strong> <?php echo $aparato->getUbicacionCompleta(); ?></p>
    <p><strong>Fecha Adquisición:</strong> <?php echo $aparato->getFechaAdquisicion(); ?> (<?php echo $aparato->getAntiguedad(); ?> años)</p>
    <p><strong>Estado:</strong> <?php echo $aparato->getEstado(); ?></p>
    
    <h3>Características Específicas</h3>
    <?php if ($aparato->getTipoAparato() == 'desfibrilador'): ?>
        <p><strong>Energía Máxima:</strong> <?php echo $aparato->getEnergiaMaxima(); ?> J</p>
    <?php elseif ($aparato->getTipoAparato() == 'rayosx'): ?>
        <p><strong>Potencia:</strong> <?php echo $aparato->getPotenciaKv(); ?> kV</p>
    <?php elseif ($aparato->getTipoAparato() == 'respirador'): ?>
        <p><strong>Modo Ventilación:</strong> <?php echo $aparato->getModoVentilacion(); ?></p>
    <?php endif; ?>
    
    <div style="margin-top: 20px;">
        <a href="index.php" class="btn">← Volver</a>
    </div>
</div>

<?php include 'views/footer.php'; ?>