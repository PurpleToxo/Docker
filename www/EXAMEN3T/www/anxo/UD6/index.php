<?php
require 'flight/Flight.php';
// "Base de datos" en memoria con tareas iniciales
$GLOBALS['tareas'] = [
    ['id' => 1, 'titulo' => 'Estudiar para el examen', 'completada' => false],
    ['id' => 2, 'titulo' => 'Hacer la compra', 'completada' => true],
    ['id' => 3, 'titulo' => 'Llamar al dentista', 'completada' => false]
];

// ============================
// GET - Ver todas las tareas
// ============================
Flight::route('GET /tareas', function () {
    Flight::json($GLOBALS['tareas']);
});
// ============================
// GET - Ver solo las pendientes
// ============================
Flight::route('GET /tareas/pendientes', function () {
    $pendientes = [];
    foreach ($GLOBALS['tareas'] as $tarea) {
        if ($tarea['completada'] === false) {
            $pendientes[] = $tarea;
        }
    }
    Flight::json([
        'cantidad' => count($pendientes),
        'tareas' => $pendientes
    ]);
});
// ============================
// GET - Ver solo las completadas
// ============================
Flight::route('GET /tareas/completadas', function () {
    $completadas = [];
    foreach ($GLOBALS['tareas'] as $tarea) {
        if ($tarea['completada'] === true) {
            $completadas[] = $tarea;
        }
    }
    Flight::json([
        'cantidad' => count($completadas),
        'tareas' => $completadas
    ]);
});
// ============================
// GET - Ver una tarea concreta por id
// ============================
Flight::route('GET /tareas/@id', function ($id) {
    foreach ($GLOBALS['tareas'] as $tarea) {
        if ($tarea['id'] == $id) {
            Flight::json($tarea);
            return;
        }
    }
    // Si no la encontramos
    Flight::json(['error' => "No existe ninguna tarea con id $id"], 404);
});
// ============================
// POST - Crear una tarea nueva
// ============================

Flight::route('POST /tareas', function () {
    $titulo = Flight::request()->data->titulo;
    if (empty($titulo)) {
        Flight::json(['error' => 'El título es obligatorio'], 400);
        return;
    }
    // Calculamos el siguiente id
    $nuevo_id = count($GLOBALS['tareas']) + 1;
    $nueva_tarea = [
        'id' => $nuevo_id,
        'titulo' => $titulo,
        'completada' => false
    ];
    $GLOBALS['tareas'][] = $nueva_tarea;
    Flight::json([
        'mensaje' => 'Tarea creada correctamente',
        'tarea' => $nueva_tarea
    ], 201);
});
// ============================
// POST - Marcar una tarea como completada
// ============================
Flight::route('POST /tareas/@id/completar', function ($id) {
    foreach ($GLOBALS['tareas'] as $i => $tarea) {
        if ($tarea['id'] == $id) {
            $GLOBALS['tareas'][$i]['completada'] = true;
            Flight::json([
                'mensaje' => "Tarea $id marcada como completada",
                'tarea' => $GLOBALS['tareas'][$i]
            ]);
            return;
        }
    }
    Flight::json(['error' => "No existe ninguna tarea con id $id"], 404);
});

// ============================
// DELETE - Eliminar una tarea
// ============================
Flight::route('DELETE /tareas/@id', function ($id) {
    foreach ($GLOBALS['tareas'] as $i => $tarea) {
        if ($tarea['id'] == $id) {
            unset($GLOBALS['tareas'][$i]);
            Flight::json([
                'mensaje' => "Tarea con id $id borrada correctamente",
                'tarea_borrada' => $tarea
            ]);
            return;
        }
    }
    Flight::json(['error' => "No existe ninguna tarea con id $id"], 404);
});

Flight::start();
