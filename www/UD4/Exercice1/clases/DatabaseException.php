<?php
class DatabaseException extends Exception {
    private $method;
    private $sql;


    public function __construct($message, $method = null, $sql = null, $code = 0, Exception $previous = null){
        parent::__construct($message, $code, $previous);
        $this->method = $method;
        $this->sql = $sql;
    }

}
?>