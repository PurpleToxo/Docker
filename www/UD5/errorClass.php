<?php
class ErroresMios extends Exception{
    private $valor;
    public function __construct($message, $valor, $code=0,Exception $previous=null){
        parent::__construct($message,$code,$previous);
        $this->valor = $valor;
    }
    public function getValor(){
        return $this->valor;
    }
}


?>