<?php
session_start();
if($_SESSION['rol']!=1){
    header('Location: idex.php');
    exit;
}
?>