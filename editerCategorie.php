<?php
/*
Nom du fichier : editerCategorie.php
Auteur : Florent BENEY
Date de création : 05.06.2018
Description : Cette page permet à l'admin d'ajouter une catégorie,
ou d'en modifier une existante
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
$succes;
$erreur;
$ajout = true;
$lienImageCategorie;
$descriptionCategorie;
$nomCategorie;
$idCategorie;
if(isset($_GET['idCategorie'])){
    $ajout = false;
    //Récupérer la catégorie à modifier
    $idCategorie = filter_input(INPUT_GET, 'idCategorie', FILTER_VALIDATE_INT);
    $categorie = GetCategorie($idCategorie)[0];
    $nomCategorie = $categorie['nom'];
    $lienImageCategorie = $categorie['lienImage'];
    $descriptionCategorie = $categorie['description'];
}

//Lors du click sur le bouton 'Editer'
if(filter_has_var(INPUT_POST, 'editer')){

    //Récupérer les infos
    $nomCategorie = trim(filter_input(INPUT_POST, 'nomCategorie', FILTER_SANITIZE_STRING));
    $lienImageCategorie = trim(filter_input(INPUT_POST, 'lienImageCategorie', FILTER_SANITIZE_STRING));
    $descriptionCategorie = trim(filter_input(INPUT_POST, 'descriptionCategorie', FILTER_SANITIZE_STRING));

    //Vérifier qu'aucun champ ne soit vide
    if($nomCategorie != "" && $lienImageCategorie != "" && $descriptionCategorie != ""){
        //Si c'est un ajout
        if($ajout){
            InsererCategorie($nomCategorie, $lienImageCategorie, $descriptionCategorie);
            //Afficher le message de succès
            $succes = "La catégorie a bien été ajoutée. <a href=\"gererCategories.php\">Retour aux catégories</a>";
            //Remettre les variables à une valeur nulle
            $lienImageCategorie = "";
            $descriptionCategorie = "";
            $nomCategorie = "";
        }else{
            //Sinon c'est une modification
            MajCategorie($idCategorie, $nomCategorie, $descriptionCategorie, $lienImageCategorie);
            //Afficher le message de succès
            $succes = "La catégorie a bien été modifiée. <a href=\"gererCategories.php\">Retour aux catégories</a>";
            //Remettre les variables à une valeur nulle
            $lienImageCategorie = "";
            $descriptionCategorie = "";
            $nomCategorie = "";
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

    <title><?php echo ($ajout) ? "Ajout catégorie" : "Modifier catégorie"; ?> - DevSkills</title>
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
                            <?php echo ($ajout) ? "Ajout d'une catégorie" : "Modification d'une catégorie"; ?>
                        </p>
                        <p class="separator">
                            <?php
                            echo ($ajout)
                            ? "Cette page permet d'ajout une nouvelle catégorie à laquelle les tutoriels pourront enusite faire parti"
                            : "Cette page permet de modifier le nom d'une catégorie existante"; ?>
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Fin section explication de la page -->

    <!-- Début section ajouter / modifier catégorie -->
    <div id="contact" class="paddsection">
        <div class="container">
            <div class="contact-block1">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="container">
                            <h1><?php echo ($ajout) ? "Ajouter une " : "Modifier une "; ?> catégorie</h1>
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
                                        <input type="text" class="form-control" name="nomCategorie" placeholder="Nom de la catégorie" value="<?php echo $nomCategorie; ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="lienImageCategorie" placeholder="Lien de l'image de la catégorie" value="<?php echo $lienImageCategorie; ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="descriptionCategorie" placeholder="Description de la catégorie" cols="50" required><?php echo $descriptionCategorie; ?></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <a href="gererCategories.php" class="btn btn-defeault btn-send">Retour</a>
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
    <!-- Fin section ajouter / modifier catégorie -->

    <!-- Début pied de page -->
    <?php include 'inc/footer.inc.php'; ?>
    <!-- Fin pied de page -->

    <!-- Début JS -->
    <?php include 'inc/templateJS.inc.php'; ?>
    <!-- Fin JS -->

</body>

</html>
