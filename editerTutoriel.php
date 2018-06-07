<?php
/*
Nom du fichier : editerTutoriel.php
Auteur : Florent BENEY
Date de création : 06.06.2018
Description : Cette page permet à l'admin d'ajouter un tutoriel,
ou d'en modifier un existant
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
$categories = GetCategories();
$succes;
$erreur;
$ajout = true;
$titreTutoriel;
$contenuTutoriel;
$categorieTutoriel;
$idTutoriel;
if(isset($_GET['idTutoriel'])){
    $ajout = false;
    //Récupérer le tutoriel à modifier
    $idTutoriel = filter_input(INPUT_GET, 'idTutoriel', FILTER_VALIDATE_INT);
    $tutoriel = GetTutoriel($idTutoriel)[0];
    $titreTutoriel = $tutoriel['titre'];
    $contenuTutoriel = $tutoriel['contenu'];
    $categorieTutoriel = $tutoriel['idCategorie'];
}

//Lors du click sur le bouton 'Editer'
if(filter_has_var(INPUT_POST, 'editer')){

    //Récupérer les infos
    $titreTutoriel = trim(filter_input(INPUT_POST, 'titreTutoriel', FILTER_SANITIZE_STRING));
    $contenuTutoriel = trim(filter_input(INPUT_POST, 'contenuTutoriel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $categorieTutoriel = trim(filter_input(INPUT_POST, 'categorieTutoriel', FILTER_VALIDATE_INT));

    //Vérifier qu'aucun champ ne soit vide
    if($titreTutoriel != "" && $contenuTutoriel != "" && $categorieTutoriel != ""){
        //Si c'est un ajout
        if($ajout){
            InsererTutoriel($titreTutoriel, $contenuTutoriel, $categorieTutoriel);
            //Afficher le message de succès
            $succes = "Le tutoriel a bien été ajouté. <a href=\"gererTutoriels.php\">Retour aux tutoriels</a>";
            //Remettre les variables à une valeur nulle
            $titreTutoriel = "";
            $contenuTutoriel = "";
            $categorieTutoriel = "";
        }else{
            //Sinon c'est une modification
            MajTutoriel($idTutoriel, $titreTutoriel, $contenuTutoriel, $categorieTutoriel);
            //Afficher le message de succès
            $succes = "Le tutoriel a bien été modifié. <a href=\"gererTutoriels.php\">Retour aux tutoriels</a>";
            //Remettre les variables à une valeur nulle
            $titreTutoriel = "";
            $contenuTutoriel = "";
            $categorieTutoriel = "";
            $ajout = true;
        }
    }

}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Balises meta -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo ($ajout) ? "Ajout" : "Modifier"; ?> tutoriel - DevSkills</title>
    <meta content="Site de tutoriels informatiques" name="description">

    <!-- Début CSS -->
    <?php include 'inc/templateCSS.inc.php'; ?>
    <!-- Fin CSS -->

    <!-- Début Trumbowyg -->
    <?php include 'trumbowyg/inc/trumbowygCSS.inc.php'; ?>
    <!-- Fin Trumbowyg -->

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
                            <?php echo ($ajout) ? "Ajout d'un tutoriel" : "Modification d'un tutoriel"; ?>
                        </p>
                        <p class="separator">
                            <?php
                            echo ($ajout)
                            ? "Cette page permet d'ajout un nouveau tutoriel"
                            : "Cette page permet de modifier un tutoriel existant"; ?>
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Fin section explication de la page -->

    <!-- Début section ajouter / modifier tutoriel -->
    <div id="contact" class="paddsection">
        <div class="container">
            <div class="contact-block1">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="container">
                            <h1><?php echo ($ajout) ? "Ajouter un " : "Modifier un "; ?> tutoriel</h1>
                            <br>
                        </div>

                        <?php if ($succes != null) { ?>
                            <div id="sendmessage"><?php echo "$succes"; ?></div>
                        <?php }
                        if ($erreur != null) { ?>
                            <div id="errormessage"><?php echo "$erreur"; ?></div>
                        <?php } ?>

                        <form action="" method="post" role="form">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="titreTutoriel" placeholder="Titre du tutoriel" value="<?php echo $titreTutoriel; ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="contenuTutoriel">Contenu du tutoriel</label>
                                        <textarea id="TrumbowygEditor" class="form-control" name="contenuTutoriel" placeholder="Contenu du tutoriel" cols="50" required>
                                            <?php echo html_entity_decode($contenuTutoriel); ?>
                                        </textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="categorieTutoriel">Catégorie du tutoriel</label>
                                        <select name="categorieTutoriel" style="width : 100%">
                                            <?php foreach ($categories as $value) { ?>
                                                <option value="<?php echo $value['id']; ?>" <?php echo ($value['id'] == $categorieTutoriel) ? "selected" : "";?>><?php echo $value['nom']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <a href="gererTutoriels.php" class="btn btn-defeault btn-send">Retour</a>
                                </div>

                                <div class="col-lg-6">
                                    <input type="submit" class="btn btn-defeault btn-send" value="<?php echo ($ajout) ? "Ajouter" : "Modifier"; ?>" name="editer">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin section ajouter / modifier tutoriel -->

    <!-- Début pied de page -->
    <?php include 'inc/footer.inc.php'; ?>
    <!-- Fin pied de page -->

    <!-- Début JS -->
    <?php include 'inc/templateJS.inc.php'; ?>
    <!-- Fin JS -->

    <!-- Début Trumbowyg -->
    <?php include 'trumbowyg/inc/trumbowygJS.inc.php'; ?>
    <!-- Fin Trumbowyg -->

</body>

</html>
