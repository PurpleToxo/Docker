<?php

/* PDO
function get_connection(){

    $servername = 'db';
    $dbname = 'donation';
    $user = 'admin';
    $password = 'test';

    try{
        $connection=new PDO ("mysql:host=$servername,dbname=$dbname",$user,$password);
        $connection ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "to correcto";
        return "connection";
    }catch(PDOException $e){
        echo "Error" . $e-> getMessage();
    }
}
function create_DB($connection){
    $sql='CREATE DATABASE IF NOT EXISTS donations';
    $stmt = $connection->prepare($sql);
    $stmt->execute();
}
function use_DB ($connection){
    $sql='USE donation';
    $stmt = $connection->prepare($sql);
    $stmt->execute();
}
function create_table($connection){
    $sql="CREATE TABLE IF NOT EXISTS donantes(
        id int (6) auto increment primary key,
        nombre varchar(200) not null,
        email varchar(200) not null
    )";
    $stmt = $connection -> prepare($sql);
    $stmt -> execute();
}
function insert_donante($connection, $nombre,$email){
    $sql = "INSERT INTO donantes (nombre,email) values(?;?)";
    $stmt = $connection ->prepare($sql);
    $stmt -> execute([$nombre,$email]);
}
function select_donantes ($connection, $nombre){
    $sql = "SELECT * FROM donantes WHERE nombre =?";
    $stmt = $connection -> prepare($sql);
    $stmt -> execute ([$nombre]);
    return $stmt ->fetchAll(PDO::FETCH_ASSOC);
}
function update_donantes ($connection,$id, $nombre, $email){
    $sql = "UPDATE donantes SET nombre = ?, email =? WHERE id = ?";
    $stmt = $connection ->prepare($sql);
    $stmt -> execute ([$nombre,$email,$id]);
}
function delete_donantes($connection , $id){
    $sql="DELETE FROM donantes WHERE id=?";
    $stmt =$connection -> prepare($sql);
    $stmt -> execute([$id]);
}
 */


/* OOP  
function executeQuery ($connection, $sql){
    $stmt = $connection ->query($sql);
    if ($stmt == false){
        die("Error execiting query: " .$connection-> error);
    }
    return $stmt;
}

function getConnection(){
    $connection = new mysqli ('db','user','test');
    if ($connection -> connect_errno !==0){
        die ("Connection failed " . $connection ->connect_error);
    }
    return $connection;
}

function connect_DB($connection){
    $sql="CREATE DATABASE IF NOT EXISTS donation";
    return executeQuery($connection,$sql);
}
function use_DB($connection){
    $sql="USE donation";
    return executeQuery($connection,$sql);
}

function create_table ($connection){
    $sql=" CREATE TABLE IF NOT EXISTS donantes(
        id INT (6) auto increment primary key,
        nombre varchar (200) not null,
        email varchar (200) not null
        )";
    return executeQuery ($connection,$sql);
}
function insert_donate($connection, $nombre, $email){
    $sql="INSERT INTO donantes (nombre,email) values ($nombre, $email)";
    return executeQuery($connection,$sql);
}
function select_donantes ($connection, $id){
    $sql ="SELECT * FROM donantes WHERE id = $id";
    return executeQuery($connection,$sql);
}
function update_donantes ($connection,$id,$nombre,$email){
    $sql="UPDATE donantes SET nombre = $nombre, email = $email WHERE id = $id";
    return executeQuery($connection,$sql);
}
function delete_donantes ($connection,$id){
    $sql ="DELETE FROM donantes WHERE id = $id";
    return executeQuery($connection,$sql);
} */
?>
--------------------------------------------------------------------------------
<?php    
/* session_start();

$_SESSION['nombre']='Pepe';
print_r($_SESSION);
echo "Mi nombre es " . $_SESSION['nombre'];

if(!isset($_SESSION['session_token'])){
    $_SESSION['session_token'] = bin2hex(random_bytes(32));
} */
?>
<!-- /* Despues en el propio formulario */
<form method='post' action="<?php echo htmspecialchars($_SERVER['PHP_SELF']); ?>">
    <label>Usuario</label>
    <input type="text" name="user" placeholder="Usuario">
    <label>Contraseña</label>
    <input type="password" name="password" placeholder="Contraseña">
    <input type="hidden" name="session_token" value="<?php echo htmlspecialchars($_SESSION['session_token']); ?>">
</form> -->

<?php
/* session_start();

if (!isset ($_SESSION['session_token'], $_POST['session_token']) || !hash_equals($_SESSION['session_token'], $_POST['session_token'])){
    die("Error: Marca de sesión inválida.");
}
$user = $_POST['user'] ?? '';
$password = $_POST['password'] ?? '';

$user_valido = 'admin';
$password_valida = 'test';

if ($user !== $user_valido || $password !== $password_valida){
    die ("Error: Usuario o contraseña no válidos.");
}

session_regenerate_id(true);

$_SESSION['authenticated'] = true;
$_SESSION['user'] = $user;*/
?> 
-----------------------------------------------------------------------------------
<?php
/* cookies
$cookie_name ="user";
$cookie_value="Pepe";

setCookie($cookie_name, $cookie_value,time() + (86400*30), "/");

echo "Cookie '" . $cookie_name . "' con valor '" . $_COOKIE[$cookie_name] . "' existe.";
 */


/* Files
$text ="Es la línea que va a guardarse en un JSON porque me apetece y porque es una práctica de PHP. Además, me gusta mucho PHP y quiero aprenderlo bien, así que esta es una buena forma de practicarlo. Espero que esta línea se guarde correctamente en el fichero JSON y que pueda leerla después sin problemas.";
$fichero = fopen ("fichero.json", "w") or die("No se pudo abrir");
fwrite($fichero, json_encode($text));
fclose($fichero);

$lectura = fopen ("fichero.json", "r") or die("no se pudo abrir");
echo fread($lectura, filesize("fichero.json"));
fclose($lectura);


$carpeta = __DIR__ . '/uploads';
if (!is_dir($carpeta) && !mkdir ($carpeta, 0755, true)){
    die ("Error no se encontro la carpeta o no se pudo crear");
}

if ($_SERVER['REQUEST_METHOD']==='POST'){
    if(!isset($_FILES['fieldName'])){
        die ("Error: No se ha enviado un archivo.");
    }
    
    $file = $_FILES['fieldName'];
    if ($file['error'] !== UPLOAD_ERR_OK){
        die("Error: Fallo al subir el archivo.");
    }

    if ($file['size'] > 500000){
        die("Error: El archivo es muy grande.");
    }

    $filename = basename($file['name']);
    $ficheroDestino = $carpeta . $filename;

    $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowedExtension = ['jpg','png','pdf','json'];
    if (!in_array($fileExtension, $allowedExtension)){
        die ("Error: Tipo de archivo no permitido.");
    }

    if(file_exists($ficheroDestino)){
        die ("Error: El fichero ya existe.");
    }

    if (!move_uploaded_file($file['tmp_name'], $ficheroDestino)){
        die("Error: no se pudo guardar el archivo."); 
    }

} */

/*clases*/
/* interface Identificable{
    public function getNombre() : String;
    public function getColor(): String;
}

class Fruta implements Identificable{
    protected $nombre;
    protected $color;

    protected function __construct($nombre,$color){
        $this -> nombre = $nombre;
        $this -> color = $color;
    }
    public static function pudrir(){
        return "Se pudre la fruta";
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function getColor(){
        return $this->color;
    }
    public function setNombre ($nombre){
        $this->nombre=$nombre;
    }
    public function setColor($color){
        $this->color = $color;
    }
}

trait Comestible{
    public function comer(){
        return "Estoy comiendo la fruta " . $this->nombre;
    }
}

class Manzana extends Fruta{
    use Comestible;

    protected $variedad;

    public  function __construct($nombre,$color,$variedad){
        parent::__construct ($nombre,$color);
        $this->variedad =$variedad;
    }

    public  function getVariedad(){
        return $this->variedad;
    }
    public function setVariedad($variedad){
        $this->variedad = $variedad;
    }
}

class Errores extends Exception{
    protected $txt;

    public function __construct($message, $txt, $codigo =0, Exception $previous = null){
        parent::__construct ($message, $codigo, $previous);
        $this->txt = $txt;
    }

    public function getTxt(){
        return $this->txt;
    }
}

function probarErrores($x){
    if($x <0){
        throw new Errores ("Error: El numero no puede ser negativo.", $x);
    }
}

try{
	echo probarErrores(3);
	echo probarErrores(-2);
}catch(Errores $e){
	echo $e->message;
} */


    s
/*Flight*/
/* require 'flight/Flight.php';

Flight::start();

Flight::route("/saludar", function(){
    Echo "Hola, bienvenido a mi API";
});

//POO Flight::register("db","mysqli","db","user","test"); 

Flight::register("db","PDO",array("mysql:host=db;dbname=agenda","user","test"));

Flight::route("get /contactos", function(){
    $sql= "SELECT * FROM contactos";
    $stmt =Flight::db()->prepare($sql);
    $stmt->execute();
    return Flight::json($stmt->fetchAll());
});
Flight::route("get /contactos/@id", function(){
    $sql= "SELECT * FROM contactos WHERE id = ?";
    $stmt =Flight::db()->prepare($sql);
    $stmt->execute(['$id']);
    return Flight::json($stmt->fetchAll());
});

Flight::route("POST /contactos", function(){
    $id=Flight::request()->data->id;
    $nombre = Flight::request()->data->nombre;
    $email = Flight::request()->data->email;

    $sql="INSERT INTO contactos(id,nombre,email) VALUES(?,?,?)";
    $stmt = Flight::db()->prepare($sql);
    $stmt ->execute(['$id','$nombre','$email']);
});

Flight::route("DELETE /contactos/@id", function(){
    $id = Flight::request()->data->id;
    $sql="DELETE FROM contactos WHERE id=?";
    $stmt = Flight::db()->prepare($sql);
    $stmt -> execute([$id]);
});

FLight::route("PUT /constactos/@id", function(){
    $id = Flight::request()->data->id;
    $nombre=Flight::request()->data->nombre;
    $email=Flight::request()->data->email;

    $sql="UPDATE contactos SET nombre=?, email=? WHERE id=?";
    $stmt = Flight::db()->prepare($sql);
    $stmt -> execute(['$nombre','$email','$id']);
}); */
?>