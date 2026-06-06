<?php
session_start();
if(isset($_GET['action']) && $_GET['action'] =='logout'){
    $_SESSION =[];
    session_destroy();
    header ('Location: login.php');
    exit;
}
?>