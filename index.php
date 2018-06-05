<?php
/*
Nom du fichier : index.php
Auteur : Florent BENEY
Date de création : 04.06.2018
Description : Cette page permet à l'utilisateur de se connecter à son compte
*/
require 'functPHP/functions.php';

//Si l'utilisateur est déjà connecté
if($_SESSION['logged']){
    header('location:accueil.php');
    exit();
}

//Variables
$nom = (isset($_GET['nom'])) ? $_GET['nom'] : "";
$erreur;
$redirectionURL;

if(filter_has_var(INPUT_POST, 'connexion')){

    //Récupérer les infos
    $nom = trim(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING));
    $motDePasse = trim(filter_input(INPUT_POST, 'motDePasse', FILTER_SANITIZE_STRING));

    //Vérifier que aucun champ n'est vide
    if($nom != "" && $motDePasse != ""){
        //Hasher le mot de passe en sha256 avec le Salt
        $motDePasse = hash('sha256', (SALT . $motDePasse));
        $login = Login($nom, $motDePasse);
        //Si le login est différent de False, c'est que la connexion a réussi
        //et que la variable $login contient l'id, l'email
        //ainsi qu'une variable bool indiquant si l'utilisateur est admin ou pas
        if($login != false){
            $_SESSION['logged'] = true;
            $_SESSION['nom'] = $nom;
            $_SESSION['id'] = $login['id'];
            $_SESSION['admin'] = $login['admin'];
            $_SESSION['email'] = $login['email'];
            //La redirection ne sera pas la même si l'utilisateur est admin
            if($_SESSION['admin']){
                $redirectionURL = "admin.php";
            }else{
                $redirectionURL = "accueil.php";
            }
            //Rediriger l'utilisateur
            header("location:$redirectionURL");
            exit();
        }else{
            $erreur = "Nom ou mot de passe incorrect";
        }
    }else{
        $erreur = "Veuillez remplir tous les champs";
    }

}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Balises meta -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Connexion - DevSkills</title>
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

    <!-- Début section explication du site -->
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
    <!-- Fin section explication du site -->

    <!-- Début section connexion -->
    <div id="contact" class="paddsection">
        <div class="container">
            <div class="contact-block1">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="container">
                            <h1>Se connecter</h1>
                            <br>
                        </div>

                        <?php if ($erreur != null) { ?>
                            <div id="errormessage"><?php echo "$erreur"; ?></div>
                        <?php } ?>

                        <form action="" method="post" role="form">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php echo $nom; ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="motDePasse" placeholder="Mot de passe" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <input type="submit" class="btn btn-defeault btn-send" value="Connexion" name="connexion">
                                </div>

                            </div>
                        </form>
                        <p>Vous n'avez pas de compte ? <a href="inscription.php">S'inscrire</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin section connexion -->

    <!-- Début pied de page -->
    <?php include 'inc/footer.inc.php'; ?>
    <!-- Fin pied de page -->

    <!-- Début JS -->
    <?php include 'inc/templateJS.inc.php'; ?>
    <!-- Fin JS -->

</body>

</html>
