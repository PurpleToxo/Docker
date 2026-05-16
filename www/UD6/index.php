<?php
/*rutas flight
Ejemplo de estructura de flight

Flight::rute('GET|POST|DELETE|PUT/ ruta(estilo url)', function(){
    codigo;
} )
*/



/**Parte dedicada a la entrada de los usuario y su verificacion */
Flight::route('GET /register', function($nombre, $email, $password){
    /*Aqui poner codigo para registrar peña*/
});

Flight::route('GET /login', function($email,$password){
    /*Aqui poner codigo para login*/
});



/**Parte de peticiones a db*/

Flight::register('db','PDO',array('mysql:host=db;dbname=agenda','root','test'));


/**Parte de modificación a db */

Flight::route('GET /contactos', function(){
    /*Codigo para recuerar contactos del usuario*/
    $stmt=Flight::db()->prepare('SELECT * from contactos');
    $stmt->execute();
    $contactos=$stmt->fetchAll();
    Flight::json($contactos);
});

Flight::route('GET /contactos/@id',function(){
    /*lo mismo que antes pero con id*/
    $id=Flight::request()->data->id;
    $stmt=Flight::db()->prepare('SELECT * from contactos WHERE id=:id');
    $stmt->execute(['id'=>$id]);
    $contactos=$stmt->fetchAll();
    Flight::json($contactos);

});

Flight::route('POST /constactos', function(){
    /*Codigo para añadir contacto*/ 
    $nombre=Flight::request()->data->nombre;
    $telefono=Flight::request()->data->telefono;
    $email=Flight::request()->data->email;
    $stmt=Flight::db()->prepare('INSERT INTO contactos(nombre,telefono,email)values(:nombre,:telefono,:email)');
    $stmt->execute(['nombre'=>$nombre, 'telefono'=>$telefono, 'email'=>$email]);
});

Flight::rute('PUT /contactos/@id',function(){
    /*Codigo para actualizar*/

    /**Recuperamos los datos con los que trabajaremos */
    $id=Flight::request()->data->id;
    $nombre=Flight::request()->data->nombre;
    $telefono=Flight::request()->data->telefono;
    $email=Flight::request()->data->email;

    /**Realizamos la peticion sql */
    $stmt=Flight::db()->prepare('UPDATE contactos SET nombre=:nombre, telefono=:telefono, email=:email WHERE id=:id');
    $stmt->execute(['nombre'=>$nombre, 'telefono'=>$telefono, 'email'=>$email, 'id'=>$id]);
});

Flight::route('DELETE /constactos/@id',function(){
    /**codigo para eliminar usuario */
    /**Recuperamos el id enviado por el json */
    $id=Flight::request()->data->id;

    /**Realizamos la peticion sql */
    $stmt=Flight::db()->prepare('DELETE FROM contactos WHERE id=?');
    $stmt->bindParam(1, $id);
    $stmt->execute();
})


?>