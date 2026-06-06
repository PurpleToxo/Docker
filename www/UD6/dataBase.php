<?php
/* conexion a base de datos */
/**Conexion */

/** Con PDO 
 * Flight::register('db','PDO', array('mysql:host=localhost, dbname=dbname', 'root','test'));*/
Flight:register('db','mysqli','db', 'root','test');

/*select simple de contactos*/
Flight::route('GET /contactos', function(){
    $stmt = Flight::db()->prepare('SELECT * FROM contactos');
    $stmt ->execute();
    $contactos = $stmt->fetchAll();
    Flight::json( $contactos);
});

/**selct con in id*/
Flight::route('GET /contactos/@id', function($id){
    $id=Flight::request()->data->id;
    $stmt = Flight::db()->prepare('SELECT * FROM contactos WHERE id=$id');
    $stmt->execute([$id]);
    $contacto=$stmt->fetchALL();
    Flight::json($contacto);
});

/**insert */
Fligth::route('POST /contactos/anadir', function($nombre, $email){
    $name = Flight::request()->data->nombre;
    $mail=Flight::request()->data->email;
    $stmt = Flight::db()->prepare('INSERT INTO contactos (nombre,email) VALUES (?,?)');
    $stmt->execute([$name, $mail]);
    $contactos = $stmt->fetchAll();
    Flight::json($contactos);

});

/**update */
Flight::route('PUT /contactos/modificar/@id', function($id, $nombre,$email){
    $nombre = Flight::request()->data->nombre;
    $email=Flight::request()->data->email;
    $id=Flight::request()->data->id;
    $stmt = Flight::db()-prepare('UPDATE contactos SET nombre=?, email=? WHERE id=?');
    $stmt ->execute([$nombre,$email,$id]);
    $contactos = $stmt ->fetchAll();
    Flight::json($contactos);
});

/**delete */
Flight::route('DELETE /contactos/eliminar/@id', function ($id){
    $id= Flight::request()->data->id;
    $stmt = Flight::db()->prepare('DELETE FROM contactos WHERE id=?');
    $stmt ->execute([$id]);
    $contactos = $stmt->fetchAll();
    Flight::json($contactos);
})


?>