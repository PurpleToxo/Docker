<DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DWCS UD2. Anexo 2. Introducción</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container-fluid">
            <h1>Anexo 2. Introducción</h1>
            <br />
            <h3>Tarea 2. Variable, declaración.</h3>
            <p>Indica cuál de los siguientes son nombres de variables válidas e inválidos e indica por qué:</p>
            <ul>
                <li>valor: no porque falta dolar</li>
                <li>$_N: válida</li>
                <li>$valor_actual: válida</li>
                <li>$n: válida</li>
                <li>$#datos: no es valida al incorporar la almohadilla</li> 
                <li>$valorInicial0: válida</li>
                <li>$proba,valor: , no es un caracter válido</li>
                <li>$2saldo: non pode comezar por número</li>
                <li>$meuProblema: válido</li>
                <li>$meu Problema: non pode levar espazo no medio</li>
                <li>$echo: válido</li>
                <li>$m&m: & non é carácter válido</li>
                <li>$registro: válido</li>
                <li>$ABC: válido</li>
                <li>$85 Nome: non pode levar espazo no medio nin comezar por numero</li>
                <li>$AAAAAAAAA: válido</li>
                <li>$nome_apelidos: válido</li>
                <li>$saldoActual: válido</li>
                <li>$92: non válido porque comeza con número</li>
                <li>$*143idade: * non é carácter válido</li>
            </ul>
            <br />
            <h3>Tarea 3. Funciones para trabajar con tipos de datos.</h3>
            <p> Busca en la documentación de PHP las funciones de manejo de variables <a href="http://www.php.net/manual/es/funcref.php">aquí</a></p>
            <p> Comprueba el resultado devuelto por los siguientes fragmentos de código:</p>
            <?php
                $a = 'true'; // imprime el valor devuelto por is_bool($a)...
                $b = 0; // imprime el valor devuelto por is_bool($b)...; y se entra dentro de if($b) {...}
                $c = 'false'; // imprime el valor devuelto por gettype($c);
                $d = ''; // el valor devuelto por empty($d);
                $e = 0.0; // el valor devuelto por empty($e);
                $f = 0; // el valor devuelto por empty($f);
                $g = false; // el valor devuelto por empty($g);
                $h; // el valor devuelto por empty($h);
                $i = '0'; // el valor devuelto por empty($i);
                $j = '0.0'; // el valor devuelto por empty($j);
                $k = true; // el valor devuelto por isset($k);
                $l = false; // el valor devuelto por isset($l);
                $m = true; // el valor devuelto por is_numeric($m);
                $n = ''; // el valor devuelto por is_numeric($n);
            ?>
    </body>
