<?php
/*
Nom du fichier : inscription.php
Auteur : Florent BENEY
Date de création : 04.06.2018
Description : Cette page permet à l'utilisateur de s'inscrire
*/
require 'functPHP/functions.php';

//Si l'utilisateur est déjà connecté
if($_SESSION['logged']){
    header('location:accueil.php');
    exit();
}

//Variables
$nom;
$email;
$erreur;
$succes;

if(filter_has_var(INPUT_POST, 'inscription')){

    //Récupérer les infos
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $nom = trim(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING));
    $motDePasse = trim(filter_input(INPUT_POST, 'motDePasse', FILTER_SANITIZE_STRING));
    $motDePasseRepete = trim(filter_input(INPUT_POST, 'motDePasseRepete', FILTER_SANITIZE_STRING));

    //Vérifier que aucun champ n'est vide
    if($email != "" && $nom != "" && $motDePasse != "" && $motDePasseRepete != ""){
        //Vérifier que l'email n'est pas utilisé
        if(EmailDispo($email)){
            //Vérifier que les deux mots de passe corresponde
            if($motDePasse === $motDePasseRepete){
                //Hasher le mot de passe en sha256 avec le Salt
                $motDePasse = hash('sha256', (SALT . $motDePasse));
                //Ajouter l'utilisateur à la base (créer le compte)
                InsererUtilisateur($nom, $email, $motDePasse);
                //Afficher le message de succès
                $succes = "Votre compte a bien été créé. Veuillez suivre <a href=\"index.php?nom=".$nom."\">ce lien</a> pour vous connecter";
            }else{
                $erreur = "Les deux mots de passe doivent correspondre";
            }
        }else{
            $erreur = "Vous ne pouvez pas utiliser cet email";
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

    <title>Inscription - DevSkills</title>
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

    <!-- Début section inscription -->
    <div id="contact" class="paddsection">
        <div class="container">
            <div class="contact-block1">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="container">
                            <h1>S'inscrire</h1>
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

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php echo $nom; ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="motDePasse" placeholder="Mot de passe" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="motDePasseRepete" placeholder="Répéter le mot de passe" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <input type="submit" class="btn btn-defeault btn-send" value="Inscription" name="inscription">
                                </div>

                            </div>
                        </form>
                        <p>Vous avez déjà un compte ? <a href="index.php">Se connecter</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin section inscription -->

    <!-- Début pied de page -->
    <?php include 'inc/footer.inc.php'; ?>
    <!-- Fin pied de page -->

    <!-- Début JS -->
    <?php include 'inc/templateJS.inc.php'; ?>
    <!-- Fin JS -->

</body>

</html>
