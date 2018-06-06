<?php
/*
Nom du fichier : supprimerTutoriel.php
Auteur : Florent BENEY
Date de création : 06.06.2018
Description : Cette page permet à l'admin de supprimer un tutoriel
*/
//Intégrer les fonctions PHP
require 'functPHP/functions.php';

//Si l'utilisateur n'est pas connecté
if(!($_SESSION['logged'])){
    header('location:index.php');
    exit();
}

//Si l'utilisateur n'est pas admin
if(!($_SESSION['admin'])){
    header('location:accueil.php');
    exit();
}

//Récupérer l'id du tutoriel à supprimer
$idTutoriel = filter_input(INPUT_GET, 'idTutoriel', FILTER_VALIDATE_INT);

//Supprimer le tutoriel
SupprimerTutoriel($idTutoriel);

header("location:gererTutoriels.php");
exit();
