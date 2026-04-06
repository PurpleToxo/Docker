<?php
/*rutas flight
Ejemplo de estructura de flight

Flight::rute('GET|POST|DELETE|PUT/ ruta(estilo url)', function(){
    coddigo;
} )
*/



/**Parte dedicada a la entrada de los usuario y su verificacion */
Flight::route('GET /register', function($nombre, $email, $password){
    /*Aqui poner codigo para registrar peña*/
});

Flight::route('GET /login', function($email,$password){
    /*Aqui poner codigo para login*/
});



/**Parte de conexión a db*/

Flight::register('db','PDO',array('mysql:host=localhost;dbname=agenda','root','test'));


/**Parte de modificación a db */

Flight::route('GET /contactos', function(){
    /*Codigo para recuerar contactos del usuario*/
    $stmt=Flight::db()->prepare('SELECT * from contactos');
    $stmt->execute();
    $contactos=$stmt->fetchAll();
    Flight::json($contactos);
});

Flight::route('GET /contactos/@id',function($id){
    /*lo mismo que antes pero con id*/
    $stmt=Flight::db()->prepare('SELECT * from contactos WHERE id=:id');
    $stmt->execute(['id'=>$id]);
    $contactos=$stmt->fetchAll();
    Flight::json($contactos);

});

Flight::route('POST /constactos', function($nombre,$telefono, $email){
    /*Codigo para añadir contacto*/ 
    $stmt=Flight::db()->prepare('INSERT INTO contactos(nombre,telefono,email)values(:nombre,:telefono,:email)');
    $stmt->execute(['nombre'=>$nombre, 'telefono'=>$telefono, 'email'=>$email]);
    


});

Flight::rute('PUT /contactos/@id',function($id){
    /*Codigo para actualizar*/
});

Flight::route('DELETE /constactos/@id',function($id){
    /**codigo para eliminar usuario */
})


?>