<?php
/* conexion a base de datos */
/**Conexion */

/** Con PDO 
 * Flight::register('db','PDO', array('mysql:host=localhost, dbname=dbname', 'root','test'));*/
Flight::register('db','PDO', array("mysql:host=localhost;dbname=dbname", "root", "test"));

Flight::route('GET /contactos', function(){
    $stmt = Flight::db()->prepare("SELECT * FROM contactos");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    Flight::json($result);
});
Flight::route('POST /contactos/anadir', function(){
    
    $nombre = Flight::request()->data->nombre;
    $email = Flight::request()->data->email;
    
    $stmt = Flight::db()->prepare('INSERT INTO contactos (nombre=?,email=?)');
    $stmt->execute([$nombre,$email]);
});
Flight::route('DELETE /contactos/elimnar/@id', function($id){
    
    $stmt=Flight::db()->prepare('DELETE FROM contactos WHERE id=?');
    $stmt->execute([$id]);
});
Flight::route('PUT /contactos/modificar/@id', function($id){
    
    $nombre = Flight::request()->data->nombre;
    $email = Flight::request()->data->email;

    $stmt=Flight::db()->prepare('UPDATE contactos SET nombre=?, email=? WHERE id=?');
    $stmt->execute([$nombre,$email,$id]);
    });

?>