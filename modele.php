<?php
/*
Nom du fichier : index.php
Auteur : Florent BENEY
Date de création : 08.06.2018
Description : Cette page permet à l'utilisateur de se connecter à son compte
*/
//Intégrer les fonctions PHP
require 'functPHP/functions.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Balises meta -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>DevSkills</title>
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
                            DevSkills ? C'est quoi ?
                        </p>
                        <p class="separator">
                            DevSkills est un site Internet regroupant des tutoriels sur différents sujets informatiques.
                            Pour pouvoir en profiter, il vous suffit de posséder un compte, et vous aurez accès aux tutoriels disponibles sur le site
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Fin section explication de la page -->

    <!-- Début pied de page -->
    <?php include 'inc/footer.inc.php'; ?>
    <!-- Fin pied de page -->

    <!-- Début JS -->
    <?php include 'inc/templateJS.inc.php'; ?>
    <!-- Fin JS -->

</body>

</html>
