<?php
/*
Nom du fichier : tutoriel.php
Auteur : Florent BENEY
Date de création : 07.06.2018
Description : Cette page permet à l'utilisateur de consulter un tutoriel
*/
//Intégrer les fonctions PHP
require 'functPHP/functions.php';

//Si l'utilisateur n'est pas connecté
if(!($_SESSION['logged'])){
    header('location:index.php');
    exit();
}

//Variables
$idTutoriel = filter_input(INPUT_GET, 'idTutoriel', FILTER_VALIDATE_INT);
$retourAbo = filter_input(INPUT_GET, 'retourAbo', FILTER_VALIDATE_BOOLEAN);
$tutoriel = GetTutorielAvecAbo($idTutoriel, $_SESSION['id'])[0];

//Lors du click sur le bouton 'S'abonner'
if(filter_has_var(INPUT_POST, 'abonner')){
    if($tutoriel['abonne']){
        SupprimerAbonnement($idTutoriel, $_SESSION['id']);
    }else{
        InsererAbonnement($idTutoriel, $_SESSION['id']);
    }
    header("location:tutoriel.php?idTutoriel=$idTutoriel");
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Balises meta -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Tutoriel <?php echo $tutoriel['titre']; ?> - DevSkills</title>
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
                            Consulter le tutoriel <?php echo $tutoriel['titre']; ?>
                        </p>
                        <p class="separator">
                            Cette page vous permet de visualiser le tutoriel que vous avez choisi
                            <br>
                            <?php if ($retourAbo) { ?>
                                <a href="abonnement.php">Retour aux abonnements</a>
                            <?php }else{ ?>
                                <a href="categorie.php?idCategorie=<?php echo $tutoriel['idCategorie']; ?>">Retour à la sélection de tutoriel</a>
                            <?php } ?>
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Fin section explication de la page -->

    <!-- Début section abonnement -->
    <div id="abonnement">
        <div class="container">
            <div class="contact-block1">
                <div class="row">

                    <div class="col-lg-12">

                        <form action="" method="post" role="form">
                            <div class="row">

                                <div class="col-lg-12">
                                    <input type="submit" class="btn btn-defeault btn-send" value="<?php echo ($tutoriel['abonne']) ? "Se désabonner de ce tutoriel" : "S'abonner à ce tutoriel"; ?>" name="abonner">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin section abonnement -->

    <!-- Début section visualisation du tutoriel -->
    <div id="about" class="paddsection">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-lg-12">
                    <div class="about-descr">

                        <p class="p-heading text-center">
                            <?php echo $tutoriel['titre']; ?>
                        </p>

                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="about-descr">

                        <?php echo html_entity_decode($tutoriel['contenu']); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Fin section visualisation du tutoriel -->

    <!-- Début pied de page -->
    <?php include 'inc/footer.inc.php'; ?>
    <!-- Fin pied de page -->

    <!-- Début JS -->
    <?php include 'inc/templateJS.inc.php'; ?>
    <!-- Fin JS -->

</body>

</html>
