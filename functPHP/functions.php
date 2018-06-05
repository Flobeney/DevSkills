<?php
//Démarrer la session
session_start();
//Ajouter le fichier PDO.php pour la connexion à la base de données
require 'PDO.php';

//Modèle pour les commentaires
/**
* Renvoie les détails d'un utilisateur
*
* Récupère dans la table login les informations détaillées de l'utilisateur dont
* le login a été fourni en paramètre puis les fournit en sortie.
*
* @param string login de l'utilisateur
* @return array {id; surname; name} ou false si non valide
*/

//Fonctions Select

/**
* Indique la disponibilité d'un email
*
* Va chercher dans la base si l'email reçu en paramètre est disponible ou non
* (donc s'il est déjà utilisé ou pas)
*
* @param string Email de l'utilisateur
* @return bool 'True' si le mail est disponible, 'False' sinon
*/
function EmailDispo($email){
    $res = true;
    //Construire la requête
    $req = "SELECT email
    FROM `utilisateur`
    WHERE email = :email";
    //La préparer
    $sth = connecteur()->prepare($req);
    //L'exécuter
    $sth->execute(array(':email' => $email));
    //Récupérer le résultat
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    //Si la requête retourne un résultat, c'est que l'email est déjà utilisé
    if($array != null){
        $res = false;
    }
    //Retourner la disponibilité
    return $res;
}

/**
* Vérifie le couple nom d'utilisateur / mot de passe
*
* Va chercher dans la base si le couple nom d'utilisateur / mot de passe est correct
*
* @param string Nom de l'utilisateur
* @param string Mot de passe de l'utilisateur
* @return array {id; admin; email} ou 'False' si le couple nom d'utilisateur / mot de passe est non valide
*/
function Login($nom, $motDePasse){
    $res = false;
    //Construire la requête
    $req = "SELECT id, admin, email
    FROM `utilisateur`
    WHERE nom = :nom
    AND motDePasse = :motDePasse";
    //La préparer
    $sth = connecteur()->prepare($req);
    //L'exécuter
    $sth->execute(array(':nom' => $nom, ':motDePasse' => $motDePasse));
    //Récupérer le résultat
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    //Si la requête retourne un résultat, c'est que le login est juste
    if($array != null){
        $res = $array[0];
    }
    //Retourner le login
    return $res;
}

/*
//Fonction pour récupérer tout les posts
function GetPosts(){
    $req = "SELECT commentaire, nomFichierMedia, datePost, post.idPost, typeMedia, dateLastEdit, name, users.idUser
    FROM `post`, `media`, `users`
    WHERE post.idPost = media.idPost
    AND post.idUser = users.idUser
    ORDER BY datePost DESC";
    $sth = connecteur()->prepare($req);
    $sth->execute();
    return $sth->fetchAll();
    //return $sth->fetchAll(PDO::FETCH_ASSOC);
}

//Fonction pour récupérer un post en fonction de son id
function GetPost($id){
    $req = "SELECT commentaire, nomFichierMedia, typeMedia, post.idPost, datePost, dateLastEdit
    FROM `post`, `media`
    WHERE post.idPost = media.idPost
    AND post.idPost = :id";
    $sth = connecteur()->prepare($req);
    $sth->execute(array(':id' => $id));
    return $sth->fetchAll();
    //return $sth->fetchAll(PDO::FETCH_ASSOC);
}
*/
//Fin

//Fonctions Insert

/**
* Insère un nouvel utilisateur
*
* Insère un nouvel enregistrement dans la table 'utilisateur'
*
* @param string Nom de l'utilisateur
* @param string Email de l'utilisateur
* @param string Mot de passe de l'utilisateur
*/
function InsererUtilisateur($nom, $email, $motDePasse){
    $sql = "INSERT INTO `utilisateur` (`id`, `admin`, `nom`, `motDePasse`, `email`) VALUES (null, 0, :nom, :motDePasse, :email)";
    $sth = connecteur()->prepare($sql);
    $sth->execute(array(':nom' => $nom, ':motDePasse' => $motDePasse, ':email' => $email));
    $sth->fetch();
}

/*
//Fonction pour insérer un commentaire
function InsertComm($comm, $idUser, $idPost){
    $sql = "INSERT INTO `comment` (`idComment`, `comment`, `idUser`, `idPost`) VALUES (null, :comm, :idUser, :idPost)";
    $sth = connecteur()->prepare($sql);
    $sth->execute(array(':comm' => $comm, ':idUser' => $idUser, ':idPost' => $idPost));
    $sth->fetch();
}
*/
//Fin

//Fonctions Update
/*
//Fonction pour mettre à jour un post
function UpdatePost($id, $comm){
    $sql = "UPDATE " . DB_NAME . ".`post` SET `commentaire` = :comm, `dateLastEdit`= (SELECT NOW()) WHERE `post`.`idPost` =:id";
    $sth = connecteur()->prepare($sql);
    $sth->execute(array(':comm' => $comm, ':id' => $id));
    $sth->fetch();
}
*/
//Fin

//Fonctions Delete
/*
//Fonction pour supprimer un commentaire
function DelComm($idComm, $idUser){
    $sql = "DELETE FROM " . DB_NAME . ".`comment` WHERE `idUser` = :idUser AND `idComment` = :idComment";
    $sth = connecteur()->prepare($sql);
    $sth->execute(array(':idUser' => $idUser, ':idComment' => $idComm));
    $sth->fetch();
}
*/
//Fin

?>
