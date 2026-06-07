<?php
require 'flight/Flight.php';

// ============================================
// BASE DE DATOS EN MEMORIA - APARATOS HOSPITAL
// ============================================
$GLOBALS['aparatos'] = [
    [
        'id' => 1,
        'nombre' => 'Desfibrilador Bifásico',
        'marca' => 'Zoll',
        'modelo' => 'R Series',
        'num_serie' => 10001,
        'planta' => '2',
        'habitacion' => 'UCI-5',
        'fecha_adquisicion' => '1998-06-15',
        'estado' => 'Operativo',
        'tipo_aparato' => 'desfibrilador',
        'energia_maxima' => 200
    ],
    [
        'id' => 2,
        'nombre' => 'Desfibrilador Manual',
        'marca' => 'Physio-Control',
        'modelo' => 'Lifepak 20',
        'num_serie' => 10002,
        'planta' => '2',
        'habitacion' => 'UCI-3',
        'fecha_adquisicion' => '2001-03-10',
        'estado' => 'Mantenimiento',
        'tipo_aparato' => 'desfibrilador',
        'energia_maxima' => 360
    ],
    [
        'id' => 3,
        'nombre' => 'Desfibrilador Portátil',
        'marca' => 'Philips',
        'modelo' => 'HeartStart',
        'num_serie' => 10003,
        'planta' => '1',
        'habitacion' => 'Box 12',
        'fecha_adquisicion' => '2020-08-01',
        'estado' => 'Operativo',
        'tipo_aparato' => 'desfibrilador',
        'energia_maxima' => 150
    ],
    [
        'id' => 4,
        'nombre' => 'Máquina Rayos X Digital',
        'marca' => 'Siemens',
        'modelo' => 'Ysio Max',
        'num_serie' => 8000,
        'planta' => '0',
        'habitacion' => 'Rad-1',
        'fecha_adquisicion' => '2018-05-20',
        'estado' => 'Operativo',
        'tipo_aparato' => 'rayosx',
        'potencia_kv' => 150
    ],
    [
        'id' => 5,
        'nombre' => 'Máquina Rayos X Portátil',
        'marca' => 'Fujifilm',
        'modelo' => 'FDR Go',
        'num_serie' => 12000,
        'planta' => '1',
        'habitacion' => 'Box 5',
        'fecha_adquisicion' => '2022-01-15',
        'estado' => 'Fuera de servicio',
        'tipo_aparato' => 'rayosx',
        'potencia_kv' => 120
    ],
    [
        'id' => 6,
        'nombre' => 'Máquina Rayos X Convencional',
        'marca' => 'GE Healthcare',
        'modelo' => 'Proteus',
        'num_serie' => 4500,
        'planta' => '0',
        'habitacion' => 'Rad-2',
        'fecha_adquisicion' => '2015-11-30',
        'estado' => 'Mantenimiento',
        'tipo_aparato' => 'rayosx',
        'potencia_kv' => 100
    ],
    [
        'id' => 7,
        'nombre' => 'Respirador Mecánico',
        'marca' => 'Dräger',
        'modelo' => 'Evita V500',
        'num_serie' => 20001,
        'planta' => '2',
        'habitacion' => 'UCI-1',
        'fecha_adquisicion' => '2005-09-01',
        'estado' => 'Operativo',
        'tipo_aparato' => 'respirador',
        'modo_ventilacion' => 'Volumen Controlado'
    ],
    [
        'id' => 8,
        'nombre' => 'Respirador de Transporte',
        'marca' => 'Hamilton',
        'modelo' => 'T1',
        'num_serie' => 20002,
        'planta' => '1',
        'habitacion' => 'Urgencias',
        'fecha_adquisicion' => '2021-04-10',
        'estado' => 'Operativo',
        'tipo_aparato' => 'respirador',
        'modo_ventilacion' => 'PSV'
    ],
    [
        'id' => 9,
        'nombre' => 'Respirador Neonatal',
        'marca' => 'Maquet',
        'modelo' => 'Servo-n',
        'num_serie' => 20003,
        'planta' => '0',
        'habitacion' => 'Neonatos',
        'fecha_adquisicion' => '2003-12-20',
        'estado' => 'Fuera de servicio',
        'tipo_aparato' => 'respirador',
        'modo_ventilacion' => 'CPAP'
    ]
];

// ==========================
// FUNCIONES AUXILIARES 
// ==========================

/**
 * Calcula la antigüedad en años de un aparato a partir de su fecha de adquisición.
 */
function calcularAntiguedad($fecha_adquisicion) {
    $fecha = new DateTime($fecha_adquisicion);
    $hoy = new DateTime();
    return $fecha->diff($hoy)->y;
}

// ============================================
// GET - Todos los aparatos
// ============================================
Flight::route('GET /aparatos', function () {
    Flight::json($GLOBALS['aparatos']);
});

// ============================================
// GET - Aparato por ID
// ============================================
Flight::route('GET /aparatos/@id', function ($id) {
    foreach ($GLOBALS['aparatos'] as $aparato) {
        if ($aparato['id'] == $id) {
            Flight::json($aparato);
            return;
        }
    }
    Flight::json(['error' => "No existe ningún aparato con id $id"], 404);
});

// ============================================
// GET - Filtrar aparatos por antigüedad máxima
// Ejemplo: /aparatos/antiguedad/15  devuelve aparatos con antigüedad < 15 años
// ============================================
/**
 * --- EXAMEN ---
 * IMPLEMENTAR POR EL ALUMNO.
 * Ruta GET que reciba un número de años por parámetro (@anios).
 * Debe recorrer el array $GLOBALS['aparatos'] y devolver únicamente aquellos cuya
 * antigüedad sea MENOR al número recibido.
 * Utilizar la función calcularAntiguedad() ya programada.
 * El JSON de respuesta debe incluir: 'antiguedad_maxima', 'cantidad' y 'aparatos'.
 */
// ESCRIBIR AQUÍ LA RUTA GET 
Flight::route('GET /aparatos/antiguedad/@anios', function($anios){
   foreach($GLOBALS['aparatos'] as $aparato){
    $fechaAD = $aparato['fecha_adquisicion'];
    $differencia = calcularAntiguedad($fechaAD);
    if (differencia <15){
        Flight::json($aparato);
        return;
    }
    } 
});



// ============================================
// POST - Cambiar estado de un aparato
// Regla: 
//   Si está en "Mantenimiento" → cambiar a "Operativo"
//   Si está en "Fuera de servicio" → cambiar a "Mantenimiento"
//   Si está en "Operativo" → no cambiar, devolver mensaje informativo
// ============================================
/**
 * --- EXAMEN ---
 * IMPLEMENTAR POR EL ALUMNO.
 * Ruta POST /aparatos/@id/estado que actualice el estado del aparato según la regla indicada.
 * Pasos a seguir:
 * 1. Recorrer $GLOBALS['aparatos'] buscando el id recibido.
 * 2. Si no se encuentra, devolver error 404.
 * 3. Si se encuentra, aplicar la siguiente lógica sobre su campo 'estado':
 *    - "Mantenimiento" → cambiar a "Operativo"
 *    - "Fuera de servicio" → cambiar a "Mantenimiento"
 *    - "Operativo" → no realizar cambio
 * 4. Devolver JSON con mensaje indicando el cambio realizado (o si no hubo cambio),
 *    incluyendo el aparato actualizado.
 */
// ESCRIBIR AQUÍ LA RUTA POST 
Flight::route('POST /aparatos/@id/estado', function($id){
    foreach ($GLOBALS['aparatos'] as $aparato) {
        if ($aparato['id'] == $id) {
            if($aparato['estado'] =='Mantenimiento'){
                $aparato['estado'] = 'Operativo';
                Flight::json($aparato);
            }else if($aparato['estado'] =='Fuera de servicio'){
                $aparato['estado'] = 'Mantenimiento';
                Flight::json($aparato);
            }else if($aparato['estado'] =='Operativo'){
                return 'No hubo cambios';
            }
        }
    }
    Flight::json(['error' => "No existe ningún aparato con id $id"], 404);
});

// ============================================
// INICIAR APLICACIÓN
// ============================================
Flight::start();
?>
