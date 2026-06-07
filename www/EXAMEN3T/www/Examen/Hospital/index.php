<?php
// index.php
require_once 'config/Database.php';
require_once 'models/Aparato.php';
require_once 'models/Desfibrilador.php';
require_once 'models/MaquinaRayosX.php';
require_once 'models/Respirador.php';
require_once 'models/AparatoRepository.php';
require_once 'models/Usuario.php';
require_once 'models/Auth.php';
Auth::checkAuth();

$repo = new AparatoRepository();
$filtros = array();

if (!empty($_GET['tipo'])) {
    $filtros['tipo'] = $_GET['tipo'];
}

/**
 * --- EXAMEN ---
 * IMPLEMENTAR POR EL ALUMNO.
 * Si se ha enviado el parámetro 'planta' por GET, añadirlo al array $filtros.
 */
// ESCRIBIR AQUÍ LA LÓGICA DEL FILTRO POR PLANTA


include 'views/header.php';
?>

<h2>Listado de Aparatos</h2>

<!-- Filtros -->
<div class="card">
    <form method="GET" class="filtros">
        <div class="form-group">
            <label>Tipo</label>
            <select name="tipo">
                <option value="">Todos</option>
                <?php foreach ($tipos as $t): ?>
                    <option value="<?php echo $t; ?>" <?php if(isset($_GET['tipo']) && $_GET['tipo']==$t) echo 'selected'; ?>>
                        <?php echo ucfirst($t); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <select name="planta">
                <option value="">Todos</option>
                <?php foreach ($planta as $p): ?>
                    <option value="<?php echo $p; ?>" <?php if(isset($_GET['planta']) && $_GET['planta']==$p) echo 'selected'; ?>>
                        <?php echo ($p); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <!--
             --- EXAMEN ---
             IMPLEMENTAR POR EL ALUMNO.
             Crear un select con name="planta" para filtrar por Planta 0, Planta 1 y Planta 2 (no debe de haber más opciones).
        -->
        <!-- ESCRIBIR AQUÍ EL SELECT DE PLANTA -->
        
        <button type="submit" class="btn">Filtrar</button>
        <a href="index.php" class="btn" style="background:#6b7280;">Limpiar</a>
    </form>
</div>

<!--
     --- EXAMEN ---
     IMPLEMENTAR POR EL ALUMNO.
     Zona visible SOLO para el rol 'tecnico'.
     Debe seleccionar y mostrar los aparatos que necesitan sustitución.
     Mostrar para cada aparato una fila de tabla con: nombre, tipo, ubicación y un botón Eliminar.
     El botón Eliminar debe apuntar a eliminar.php?id=ID_DEL_APARATO, donde se gestionará la lógica de la eliminación.
-->
<!-- ESCRIBIR AQUÍ EL CUADRO DE APARATOS PENDIENTES DE SUSTITUCIÓN -->
<?php if($_SESSION['usuario']=='tecnico'): ?>
<table>
    <tr>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Ubicación</th>
        <th>Motivo</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($aparatos as $a): ?>
    <tr>
        <td><?php echo $a->getNombre(); ?></td>
        <td><?php echo ucfirst($a->getTipoAparato()); ?></td>
        <td><?php echo $a->getUbicacionCompleta(); ?></td>
        <td><?php echo $a->necesitaSustitucion();?></td>
        <td>
            <a href="eliminar.php?id=<?php echo $a->getId(); ?>" class="btn">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif;?>

<!-- Listado General -->
<table>
    <tr>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Nº Serie</th>
        <th>Ubicación</th>
        <th>Tipo</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($aparatos as $a): ?>
    <tr>
        <td><?php echo $a->getNombre(); ?></td>
        <td><?php echo $a->getMarca(); ?></td>
        <td><?php echo $a->getModelo(); ?></td>
        <td><?php echo $a->getNumSerie(); ?></td>
        <td><?php echo $a->getUbicacionCompleta(); ?></td>
        <td><?php echo ucfirst($a->getTipoAparato()); ?></td>
        <td>
            <?php 
            $cls = 'tag-op';
            if ($a->getEstado() == 'Mantenimiento') $cls = 'tag-man';
            if ($a->getEstado() == 'Fuera de servicio') $cls = 'tag-fuera';
            ?>
            <span class="tag <?php echo $cls; ?>"><?php echo $a->getEstado(); ?></span>
        </td> 
        <td>
             <!--
                 --- EXAMEN ---
                 IMPLEMENTAR POR EL ALUMNO.
                 El botón Detalle debe aparecer SOLO si el rol del usuario logueado es 'admin' o 'tecnico'.
            -->
            <?php if($_SESSION['usuario']=='admin' || $_SESSION['usuario']=='tecnico'):?>
            <a href="detalle.php?id=<?php echo $a->getId(); ?>" class="btn">Ver</a>
            <?php endif; ?>
            <!--
                 --- EXAMEN ---
                 IMPLEMENTAR POR EL ALUMNO.
                 El botón Editar debe aparecer SOLO si el rol del usuario logueado es 'admin'.
            -->
            <?php if($_SESSION['usuario']=='admin'):?>
             <a href="editar.php" class="btn" style="background:#6b7280;">Editar</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include 'views/footer.php'; ?>