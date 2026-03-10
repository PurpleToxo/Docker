<header class="bg-primary text-white text-center py-3">
    <?php
    $tema='claro';
    if (isset($_COOKIE['tema'])){
        if($_COOKIE['tema']=='oscuro'){
            $tema=$_COOKIE['tema'];
        }
    }
    header('Location:init.php')
    ?>
    <h1>Gestión de tareas</h1>
    <p>Solución tarea unidad 3 (anexo 2) de DWCS</p>
</header>