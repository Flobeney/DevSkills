<?php
/*
Nom du fichier : accueil.php
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

//Variables
$categories = GetCategories();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Balises meta -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Accueil - DevSkills</title>
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
                            Bienvenu sur DevSkills !
                        </p>
                        <p class="separator">
                            Vous voilà connecté ! Vous pouvez maintenant profiter des tutoriels présents sur le site
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Fin section explication de la page -->

    <!-- Début section catégories -->
    <div id="journal" class="text-left paddsection">

        <div class="container">
            <div class="section-title text-center">
                <h2>Catégories</h2>
            </div>
        </div>

        <div class="container">
            <div class="journal-block">
                <div class="row">

                    <?php foreach ($categories as $value) { ?>

                        <div class="col-lg-4 col-md-6">
                            <div class="journal-info text-center">

                                <a href="categorie.php?idCategorie=<?php echo $value['id']; ?>" title="Parcourir les tutoriels de la catégorie <?php echo $value['nom']; ?>">
                                    <img src="<?php echo $value['lienImage']; ?>" class="img-responsive" alt="Image de la catégorie <?php echo $value['nom']; ?>">
                                </a>

                                <div class="journal-txt text-center">
                                    <h4>
                                        <a href="categorie.php?idCategorie=<?php echo $value['id']; ?>" title="Parcourir les tutoriels de la catégorie <?php echo $value['nom']; ?>">
                                            <?php echo $value['nom']; ?>
                                        </a>
                                    </h4>
                                    <p class="separator">
                                        <?php echo $value['description']; ?>
                                    </p>
                                </div>

                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>

    </div>
    <!-- Fin section catégories -->

    <!-- Début pied de page -->
    <?php include 'inc/footer.inc.php'; ?>
    <!-- Fin pied de page -->

    <!-- Début JS -->
    <?php include 'inc/templateJS.inc.php'; ?>
    <!-- Fin JS -->

</body>

</html>
