<?php
//Crear cooki con: oscuro, claro, automático
//Modificar el header para que recupere esta cookie, por defecto claro
setcookie("tema", $_POST["tema"], time() + (86400*30));
?>