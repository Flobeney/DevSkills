<?php
/*
Nom du fichier : gererTutoriels.php
Auteur : Florent BENEY
Date de création : 06.06.2018
Description : Cette page permet à l'admin de gérer les tutoriels
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

//Variables
$tutoriels = GetTutoriels();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Balises meta -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Tutoriels - Admin - DevSkills</title>
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
                            Gestion des tutoriels
                        </p>
                        <p class="separator">
                            Cette page vous permet de gérer les différents tutoriels présents sur le site
                            <br><a href="admin.php">Retour à l'administration</a>
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
                <h2>Tutoriels</h2>
                <p>
                    Suivez <a href="editerTutoriel.php">ce lien</a> pour ajouter un tutoriel
                </p>
            </div>
        </div>

        <div class="container">
            <div class="journal-block">
                <div class="row">

                    <?php foreach ($tutoriels as $value) { ?>

                        <div class="col-lg-4 col-md-6">
                            <div class="journal-info text-center">

                                <a href="editerTutoriel.php?idTutoriel=<?php echo $value['id']; ?>" title="Modifier le tutoriel <?php echo $value['titre']; ?>">
                                    <img src="<?php echo $value['lienImage']; ?>" class="img-responsive" alt="Image de la catégorie <?php echo $value['nom']; ?>">
                                </a>

                                <div class="journal-txt text-center">
                                    <h4>
                                        <a href="editerTutoriel.php?idTutoriel=<?php echo $value['id']; ?>" title="Modifier le tutoriel <?php echo $value['titre']; ?>">
                                            <?php echo $value['titre']; ?>
                                        </a>
                                    </h4>
                                    <p class="separator">
                                        Catégorie : <?php echo $value['nom']; ?>
                                        <br>Appuyez sur le tutoriel pour le modifier, ou suivez
                                        <a href="supprimerTutoriel.php?idTutoriel=<?php echo $value['id']; ?>" title="Supprimer le tutoriel <?php echo $value['titre']; ?>">
                                            ce lien
                                        </a> pour le supprimer
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
