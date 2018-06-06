<?php
/*
Nom du fichier : categorie.php
Auteur : Florent BENEY
Date de création : 06.06.2018
Description : Cette page permet à l'utilisateur de consulter les tutoriels d'une catégorie
*/
//Intégrer les fonctions PHP
require 'functPHP/functions.php';

$idCategorie = filter_input(INPUT_GET, 'idCategorie', FILTER_VALIDATE_INT);

$tutoriels = GetTutorielByCategorie($idCategorie);
$nomCategorie = $tutoriels[0]['nom'];

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Balises meta -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Catégorie <?php echo $nomCategorie; ?> - DevSkills</title>
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
    <div class="home">
        <div class="container">
            <div class="header-content">
                <h1>DevSkills</h1>
                <p>Site de tutoriels informatiques</p>
            </div>
        </div>
    </div>
    <!-- Fin section header -->

    <!-- Début section explication de la page -->
    <div id="about" class="paddsection">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-lg-12">
                    <div class="about-descr">

                        <p class="p-heading">
                            Tutoriels de la catégorie <?php echo $nomCategorie; ?>
                        </p>
                        <p class="separator">
                            Cette page regroupe les tutoriels de la catégorie <?php echo $nomCategorie; ?>
                            <br><a href="accueil.php">Retour à l'accueil</a>
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Fin section explication de la page -->

    <!-- Début section tutoriels -->
    <div id="journal" class="text-left paddsection">

        <div class="container">
            <div class="section-title text-center">
                <h2>Tutoriels de la catégorie <?php echo $nomCategorie; ?></h2>
            </div>
        </div>

        <div class="container">
            <div class="journal-block">
                <div class="row">

                    <?php foreach ($tutoriels as $value) { ?>

                        <div class="col-lg-4 col-md-6">
                            <div class="journal-info text-center">

                                <div class="journal-txt text-center">
                                    <h4>
                                        <a href="tutoriel.php?idTutoriel=<?php echo $value['id']; ?>" title="Consulter le tutoriel <?php echo $value['titre']; ?>">
                                            <?php echo $value['titre']; ?>
                                        </a>
                                    </h4>
                                    <p class="separator">
                                        Appuyez sur le tutoriel pour le consulter
                                    </p>
                                </div>

                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>

    </div>
    <!-- Fin section tutoriels -->

    <!-- Début pied de page -->
    <?php include 'inc/footer.inc.php'; ?>
    <!-- Fin pied de page -->

    <!-- Début JS -->
    <?php include 'inc/templateJS.inc.php'; ?>
    <!-- Fin JS -->

</body>

</html>
