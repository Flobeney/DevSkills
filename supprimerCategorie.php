<?php
/*
Nom du fichier : supprimerCategorie.php
Auteur : Florent BENEY
Date de création : 05.06.2018
Description : Cette page permet à l'admin de supprimer une catégorie
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

//Récupérer l'id de la catégorie à supprimer
$idCategorie = filter_input(INPUT_GET, 'idCategorie', FILTER_VALIDATE_INT);

//Supprimer la catégorie
SupprimerCategorie($idCategorie);

header("location:gererCategories.php");
exit();
