<?php
/*
Nom du fichier : monCompte.php
Auteur : Florent BENEY
Date de création : 04.06.2018
Description : Cette page affiche les informations de l'utilisateur et lui permet de les modifier
*/
//Intégrer les fonctions PHP
require 'functPHP/functions.php';

//Si l'utilisateur n'est pas connecté
if(!($_SESSION['logged'])){
    header('location:index.php');
    exit();
}

//Variables
//Récupérer les informations de l'utilisateur
$infos = GetInfosUtilisateur($_SESSION['id'])[0];
$succes;
$erreur;
$emailActuel = $infos['email'];
$nomActuel = $infos['nom'];
$emailOK = false;
$nomOK = false;

//Lors du click sur le bouton 'Modifier'
if(filter_has_var(INPUT_POST, 'modifier')){

    //Récupérer les infos
    $infos['email'] = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $infos['nom'] = trim(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING));
    $motDePasseActuel = trim(filter_input(INPUT_POST, 'motDePasseActuel', FILTER_SANITIZE_STRING));
    $nouveauMotDePasse = trim(filter_input(INPUT_POST, 'nouveauMotDePasse', FILTER_SANITIZE_STRING));
    $motDePasseRepete = trim(filter_input(INPUT_POST, 'motDePasseRepete', FILTER_SANITIZE_STRING));

    //Vérifier que l'email et le nom ne soient pas vide
    if($infos['email'] != "" && $infos['nom'] != ""){

        //Si l'email a été changé
        if($infos['email'] !== $emailActuel){
            //Vérifier que l'email n'est pas utilisé
            if(EmailDispo($infos['email'])){
                $emailOK = true;
            }else{
                $erreur = "Vous ne pouvez pas utiliser cet email";
            }
        }else{
            $emailOK = true;
        }

        //Si le nom a été changé
        if($infos['nom'] !== $nomActuel){
            //Vérifier que le nom n'est pas utilisé
            if(NomDispo($infos['nom'])){
                $nomOK = true;
            }else{
                $erreur = "Vous ne pouvez pas utiliser ce nom";
            }
        }else{
            $nomOK = true;
        }

        //Si c'est ok pour le nom et l'email
        if($emailOK && $nomOK){
            //Si les mots de passe sont remplis, les modifier
            if($motDePasseActuel != "" && $nouveauMotDePasse != "" && $motDePasseRepete != ""){
                //Hasher le mot de passe en sha256 avec le Salt
                $motDePasseActuel = hash('sha256', (SALT . $motDePasseActuel));
                //Si l'ancien mot de passe est juste
                if($motDePasseActuel === $infos['motDePasse']){
                    //Vérifier que les deux mots de passe corresponde
                    if($nouveauMotDePasse === $motDePasseRepete){
                        //Hasher le mot de passe en sha256 avec le Salt
                        $nouveauMotDePasse = hash('sha256', (SALT . $nouveauMotDePasse));
                        //Mettre à jour le compte (avec le mot de passe)
                        MajCompteMDP($_SESSION['id'], $infos['nom'], $infos['email'], $nouveauMotDePasse);
                        //Afficher le message de succès
                        $succes = "Vos informations ont été modifiées avec succès";
                    }else{
                        $erreur = "Les deux mots de passe doivent correspondre";
                    }
                }else{
                    $erreur = "L'ancien mot de passe est incorrect";
                }
            }else{
                //Sinon modifier seulement le nom et l'email
                MajCompte($_SESSION['id'], $infos['nom'], $infos['email']);
                //Afficher le message de succès
                $succes = "Vos informations ont été modifiées avec succès";
            }
        }
    }else{
        $erreur = "Veuillez remplir au moins les champs \"Nom\" et \"Email\"";
    }

}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Balises meta -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Mon compte - DevSkills</title>
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
                            Mon compte
                        </p>
                        <p class="separator">
                            Cette page vous permet de modifier vos informations personnelles
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Fin section explication de la page -->

    <!-- Début section mon compte -->
    <div id="contact" class="paddsection">
        <div class="container">
            <div class="contact-block1">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="container">
                            <h1>Mes informations</h1>
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
                                        <input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php echo $infos['nom']; ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $infos['email']; ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="motDePasseActuel" placeholder="Mot de passe actuel">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="nouveauMotDePasse" placeholder="Nouveau mot de passe">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="motDePasseRepete" placeholder="Répéter le mot de passe">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <input type="submit" class="btn btn-defeault btn-send" value="Modifier" name="modifier">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin section mon compte -->

    <!-- Début pied de page -->
    <?php include 'inc/footer.inc.php'; ?>
    <!-- Fin pied de page -->

    <!-- Début JS -->
    <?php include 'inc/templateJS.inc.php'; ?>
    <!-- Fin JS -->

</body>

</html>
