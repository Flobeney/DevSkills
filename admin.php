<?php
/*
Nom du fichier : admin.php
Auteur : Florent BENEY
Date de création : 04.06.2018
Description : Cette page affiche les différentes catégories de tutoriel disponible
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

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Balises meta -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin - DevSkills</title>
    <meta content="Site de tutoriels informatiques" name="description">

    <!-- Début CSS -->
    <?php include 'inc/templateCSS.inc.php'; ?>
    <!-- Fin CSS -->

    <!-- Logo de la page -->
    <link rel="shortcut icon" href="img/logoDevSkills.png">

    <!-- =======================================================
    Theme Name: Folio
    Theme URL: https://bootstrapmade.com/folio-bootstrap-portfolio-template/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
    ======================================================= -->
</head>

<body>

    <!-- Début barre de navigation -->
    <?php include 'inc/navbar.inc.php'; ?>
    <!-- Fin barre de navigation -->

    <!-- Début section header -->
    <?php include 'inc/header.inc.php'; ?>
    <!-- Fin section header -->

    <!-- Début section explication de la page -->
    <div id="about" class="paddsection">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-lg-12">
                    <div class="about-descr">

                        <p class="p-heading">
                            Administration
                        </p>
                        <p class="separator">
                            Cette page, réservée aux administrateurs du site, leur permettent d'accéder aux différentes pages de gestion du site
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Fin section explication de la page -->

    <!-- Début section administration -->
    <div id="journal" class="text-left paddsection">

        <div class="container">
            <div class="section-title text-center">
                <h2>Administration</h2>
            </div>
        </div>

        <div class="container">
            <div class="journal-block text-center">
                <div class="row">

                    <div class="col-lg-6 col-md-8">
                        <div class="journal-info">
                            <div class="journal-txt text-center">
                                <a href="gererCategories.php" class="btn btn-defeault btn-send">Catégories</a>
                                <p class="separator">
                                    Accéder à la gestion des catégories
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-8">
                        <div class="journal-info">
                            <div class="journal-txt text-center">
                                <a href="gererTutoriels.php" class="btn btn-defeault btn-send">Tutoriels</a>
                                <p class="separator">
                                    Accéder à la gestion des tutoriels
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- Fin section administration -->

    <!-- Début pied de page -->
    <?php include 'inc/footer.inc.php'; ?>
    <!-- Fin pied de page -->

    <!-- Début JS -->
    <?php include 'inc/templateJS.inc.php'; ?>
    <!-- Fin JS -->

</body>

</html>
