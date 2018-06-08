<?php
/*
Nom du fichier : desabonner.php
Auteur : Florent BENEY
Date de création : 08.06.2018
Description : Cette page permet à l'utilisateur de se désabonner d'un tutoriel
*/
//Intégrer les fonctions PHP
require 'functPHP/functions.php';

//Si l'utilisateur n'est pas connecté
if(!($_SESSION['logged'])){
    header('location:index.php');
    exit();
}

//Récupérer l'id du tutoriel
$idTutoriel = filter_input(INPUT_GET, 'idTutoriel', FILTER_VALIDATE_INT);

//Désabonner l'utilisateur du tutoriel
SupprimerAbonnement($idTutoriel, $_SESSION['id']);

header("location:abonnement.php");
exit();
