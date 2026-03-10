<?php

require_once "mysqli/funciones.php";

$id_tarea = $_GET['id'];

$ficheros = ($id_tarea);

?>

<h2>Ficheros de la tarea</h2>

<table>
<tr>
    <th>Nombre</th>
    <th>Descargar</th>
    <th>Borrar</th>
</tr>

<?php foreach ($ficheros as $fichero) { ?>

<tr>
    <td><?php echo $fichero['nombre']; ?></td>

    <td>
        <a href="uploads/<?php echo $fichero['nombre']; ?>" download>
            <button>Descargar</button>
        </a>
    </td>

    <td>
        <form action="borrarFich.php" method="POST">
            <input type="hidden" name="id_fichero" value="<?php echo $fichero['id']; ?>">
            <button type="submit">Borrar</button>
        </form>
    </td>

</tr>

<?php } ?>

</table>