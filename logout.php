<?php 
    require_once 'header.php';
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
?>