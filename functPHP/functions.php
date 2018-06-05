<?php
//Démarrer la session
session_start();
//Ajouter le fichier PDO.php pour la connexion à la base de données
require 'PDO.php';

//Modèle pour les commentaires des fonctions
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
* Indique la disponibilité d'un nom d'utilisateur
*
* Va chercher dans la base si le nom reçu en paramètre est disponible ou non
* (donc s'il est déjà utilisé ou pas)
*
* @param string Nom de l'utilisateur
* @return bool 'True' si le nom est disponible, 'False' sinon
*/
function NomDispo($nom){
    $res = true;
    //Construire la requête
    $req = "SELECT nom
    FROM `utilisateur`
    WHERE nom = :nom";
    //La préparer
    $sth = connecteur()->prepare($req);
    //L'exécuter
    $sth->execute(array(':nom' => $nom));
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

/**
* Récupère les informations d'un utilisateur
*
* Récupère dans la table 'utilisateur' les informations détaillées de l'utilisateur dont
* l'id a été fourni en paramètre
*
* @param int ID de l'utilisateur
* @return array {nom; motDePasse; email} contenant les informations de l'utilisateur
*/
function GetInfosUtilisateur($id){
    //Construire la requête
    $req = "SELECT nom, motDePasse, email
    FROM `utilisateur`
    WHERE id = :id";
    //La préparer
    $sth = connecteur()->prepare($req);
    //L'exécuter
    $sth->execute(array(':id' => $id));
    //Récupérer le résultat
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

/**
* Récupère les catégories
*
* Récupère dans la table 'categorie' les différentes catégories contenue en base
*
* @return array {id; nom; description; lienImage} contenant les catégories
*/
function GetCategories(){
    //Construire la requête
    $req = "SELECT id, nom, description, lienImage
    FROM `categorie`
    ORDER BY nom";
    //La préparer
    $sth = connecteur()->prepare($req);
    //L'exécuter
    $sth->execute();
    //Récupérer le résultat
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

/**
* Récupère une catégorie
*
* Récupère dans la table 'categorie' une catégorie en fonction de l'id reçu comme paramètre
*
* @return array {nom; description; lienImage} contenant la catégorie
*/
function GetCategorie($id){
    //Construire la requête
    $req = "SELECT nom, description, lienImage
    FROM `categorie`
    WHERE id = :id";
    //La préparer
    $sth = connecteur()->prepare($req);
    //L'exécuter
    $sth->execute(array(':id' => $id));
    //Récupérer le résultat
    return $sth->fetchAll(PDO::FETCH_ASSOC);
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
    //Construire la requête
    $sql = "INSERT INTO `utilisateur` (`id`, `admin`, `nom`, `motDePasse`, `email`) VALUES (null, 0, :nom, :motDePasse, :email)";
    //La préparer
    $sth = connecteur()->prepare($sql);
    //L'exécuter
    $sth->execute(array(':nom' => $nom, ':motDePasse' => $motDePasse, ':email' => $email));
    $sth->fetch();
}

/**
* Insère une nouvelle catégorie
*
* Insère un nouvel enregistrement dans la table 'categorie'
*
* @param string Nom de la catégorie
* @param string Lien de l'image de la catégorie
* @param string Description de la catégorie
*/
function InsererCategorie($nomCategorie, $lienImageCategorie, $descriptionCategorie){
    //Construire la requête
    $sql = "INSERT INTO `categorie` (`id`, `nom`, `description`, `lienImage`) VALUES (null, :nom, :description, :lienImage)";
    //La préparer
    $sth = connecteur()->prepare($sql);
    //L'exécuter
    $sth->execute(array(':nom' => $nomCategorie, ':description' => $descriptionCategorie, ':lienImage' => $lienImageCategorie));
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

/**
* Met à jour le compte d'un utilisateur (nom et email uniquement)
*
* Récupère les informations entrées par l'utilisateur et met le compte à jour dans la base
*
* @param int ID de l'utilisateur
* @param string Nom de l'utilisateur
* @param string Email de l'utilisateur
*/
function MajCompte($id, $nom, $email){
    //Construire la requête
    $sql = "UPDATE " . DB_NAME . ".`utilisateur` SET `nom` = :nom, `email` = :email WHERE `utilisateur`.`id` =:id";
    //La préparer
    $sth = connecteur()->prepare($sql);
    //L'exécuter
    $sth->execute(array(':nom' => $nom, ':email' => $email, ':id' => $id));
    $sth->fetch();
}

/**
* Met à jour le compte d'un utilisateur
*
* Récupère les informations entrées par l'utilisateur et met le compte à jour dans la base
*
* @param int ID de l'utilisateur
* @param string Nom de l'utilisateur
* @param string Email de l'utilisateur
* @param string Nouveau mot de passe de l'utilisateur
*/
function MajCompteMDP($id, $nom, $email, $motDePasse){
    //Construire la requête
    $sql = "UPDATE " . DB_NAME . ".`utilisateur` SET `nom` = :nom, `email` = :email, `motDePasse` = :motDePasse WHERE `utilisateur`.`id` =:id";
    //La préparer
    $sth = connecteur()->prepare($sql);
    //L'exécuter
    $sth->execute(array(':nom' => $nom, ':email' => $email, ':motDePasse' => $motDePasse, ':id' => $id));
    $sth->fetch();
}

/**
* Met à jour une catégorie
*
* Récupère les informations entrées par l'utilisateur et met la catégorie à jour dans la base
*
* @param int ID de la catégorie
* @param string Nom de la catégorie
* @param string Description de la catégorie
* @param string Lien de l'image de la catégorie
*/
function MajCategorie($id, $nom, $description, $lienImage){
    //Construire la requête
    $sql = "UPDATE " . DB_NAME . ".`categorie` SET `nom` = :nom, `description` = :description, `lienImage` = :lienImage WHERE `categorie`.`id` =:id";
    //La préparer
    $sth = connecteur()->prepare($sql);
    //L'exécuter
    $sth->execute(array(':nom' => $nom, ':description' => $description, ':lienImage' => $lienImage, ':id' => $id));
    $sth->fetch();
}

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

/**
* Supprime une catégorie
*
* Dans la table 'categorie', supprime la catégorie correspondant à l'id reçu en paramètre
*
* @param int ID de la catégorie
*/
function SupprimerCategorie($idCategorie){
    $sql = "DELETE FROM " . DB_NAME . ".`categorie` WHERE `id` = :id";
    $sth = connecteur()->prepare($sql);
    $sth->execute(array(':id' => $idCategorie));
    $sth->fetch();
}

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
