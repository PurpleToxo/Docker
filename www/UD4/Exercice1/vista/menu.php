<?php $url_completa= 'http://'.$_SERVER['HTTP_HOST']."/UD4/Exercice1/"; ?>
<nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_completa.'index.php'?>">
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_completa.'init.php'?>">
                    Inicializar (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_completa.'usuarios/usuarios.php'?>">
                    Lista de usuarios (PDO)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_completa.'usuarios/nuevoUsuarioForm.php'?>">
                    Nuevo usuario (PDO)                    
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_completa.'tareas/tareas.php'?>">
                    Lista de tareas (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_completa.'tareas/nuevaForm.php'?>">
                    Nueva tarea (mysqli)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_completa.'tareas/buscaTareas.php'?>">
                   Buscador de tareas (PDO)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_completa.'logUser/logout.php'?>">
                   Cerrar sesión
                </a>
            </li>
            <li>
                <form class="m-3 w-50" action="tema.php" method="POST">
                    <select id="tema" name="tema" class="form-select mb-2" aria-label="Selector de tema">
                        <option value="light" selected> Claro</option>
                        <option value="dark">Oscuro</option>
                        <option value="auto">Automático</option>
                    </select>
                    <button type="submit" class="btn btn-primary w-100">Aplicar</button>
                </form>
            </li>
        </ul>
    </div>
</nav>