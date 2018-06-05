<?php
session_start();

//Si l'utilisateur n'est pas connecté
if(!($_SESSION['logged'])){
    header('location:index.php');
    exit();
}

$_SESSION = array();
session_destroy();

header("location:index.php");
exit();
