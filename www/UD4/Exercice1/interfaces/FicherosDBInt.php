<?php
interface FicherosDBInt {
    function listaFicheros($id_tarea): array;
    function buscaFichero($id): Fichero;
    function borraFichero($id): bool;
    function nuevoFichero($fichero): bool;
}
?> 