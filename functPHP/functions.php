<?php
//Démarrer la session
session_start();
//Définir les variables de sessions qui seront utilisées
$_SESSION['logged'] = (isset($_SESSION['logged'])) ? $_SESSION['logged'] : false;
$_SESSION['admin'] = (isset($_SESSION['admin'])) ? $_SESSION['admin'] : false;
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
    //Si la requête retourne un résultat, c'est que le nom est déjà utilisé
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
* Récupère dans la table 'categorie' les différentes catégories contenues en base
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
* @param int ID de la catégorie
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

/**
* Récupère les tutoriels
*
* Récupère dans la table 'tutoriel' les différents tutoriels contenus en base
*
* @return array {id; titre; nom; lienImage} contenant les tutoriels
*/
function GetTutoriels(){
    //Construire la requête
    $req = "SELECT tutoriel.id, titre, nom, lienImage
    FROM `tutoriel`, `categorie`
    WHERE idCategorie = categorie.id
    ORDER BY titre";
    //La préparer
    $sth = connecteur()->prepare($req);
    //L'exécuter
    $sth->execute();
    //Récupérer le résultat
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

/**
* Récupère un tutoriel
*
* Récupère dans la table 'tutoriel' une tutoriel en fonction de l'id reçu comme paramètre
*
* @param int ID du tutoriel
* @return array {titre; contenu; idCategorie} contenant le tutoriel
*/
function GetTutoriel($id){
    //Construire la requête
    $req = "SELECT titre, contenu, idCategorie
    FROM `tutoriel`
    WHERE id = :id";
    //La préparer
    $sth = connecteur()->prepare($req);
    //L'exécuter
    $sth->execute(array(':id' => $id));
    //Récupérer le résultat
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

/**
* Récupère les tutoriels d'une catégorie
*
* Récupère dans la table 'tutoriel' les tutoriels d'une catégorie contenus en base
*
* @param int ID de la catégorie
* @return array {id; titre; nom} contenant les tutoriels
*/
function GetTutorielByCategorie($id){
    //Construire la requête
    $req = "SELECT tutoriel.id, titre, nom
    FROM `tutoriel`, `categorie`
    WHERE idCategorie = categorie.id
    AND categorie.id = :id
    ORDER BY titre";
    //La préparer
    $sth = connecteur()->prepare($req);
    //L'exécuter
    $sth->execute(array(':id' => $id));
    //Récupérer le résultat
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

/**
* Récupère un tutoriel et sait si l'utilisateur est abonné au tutoriel qu'il consulte
*
* Récupère dans la table 'tutoriel' une tutoriel en fonction de l'id reçu comme paramètre,
* et informe si l'utilisateur est abonné au tutoriel en question
*
* @param int ID du tutoriel
* @param int ID de l'utilisateur
* @return array {titre; contenu; idCategorie; abonne} contenant le tutoriel
*/
function GetTutorielAvecAbo($idTutoriel, $idUtilisateur){
    //Construire la requête
    $req = "SELECT titre, contenu, idCategorie,
    CASE
        WHEN (SELECT COUNT(*) FROM abonnement WHERE idTutoriel = :idTutoriel AND idUtilisateur = :idUtilisateur) = 1 THEN 1
        ELSE 0
    END as abonne
    FROM `tutoriel`
    WHERE id = :idTutoriel";
    //La préparer
    $sth = connecteur()->prepare($req);
    //L'exécuter
    $sth->execute(array(':idTutoriel' => $idTutoriel, ':idUtilisateur' => $idUtilisateur));
    //Récupérer le résultat
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

/**
* Récupère les tutoriels auxquels un utilisateur est abonné
*
* Récupère dans la table 'tutoriel' les tutoriels auxquels un utilisateur est abonné contenus en base
*
* @param int ID de l'utilisateur
* @return array {id; titre; nom; lienImage} contenant les tutoriels
*/
function GetAbonnement($idUtilisateur){
    //Construire la requête
    $req = "SELECT tutoriel.id, titre, categorie.nom
    FROM `tutoriel`, `categorie`, `abonnement`, `utilisateur`
    WHERE categorie.id = idCategorie
    AND idUtilisateur = utilisateur.id
    AND idTutoriel = tutoriel.id
    AND utilisateur.id = :idUtilisateur
    ORDER BY titre";
    //La préparer
    $sth = connecteur()->prepare($req);
    //L'exécuter
    $sth->execute(array(':idUtilisateur' => $idUtilisateur));
    //Récupérer le résultat
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

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

/**
* Insère un nouveau tutoriel
*
* Insère un nouvel enregistrement dans la table 'tutoriel'
*
* @param string Titre du tutoriel
* @param string Contenu du tutoriel
* @param int ID de la catégorie du tutoriel
*/
function InsererTutoriel($titreTutoriel, $contenuTutoriel, $categorieTutoriel){
    //Construire la requête
    $sql = "INSERT INTO `tutoriel` (`id`, `titre`, `contenu`, `idCategorie`) VALUES (null, :titre, :contenu, :idCategorie)";
    //La préparer
    $sth = connecteur()->prepare($sql);
    //L'exécuter
    $sth->execute(array(':titre' => $titreTutoriel, ':contenu' => $contenuTutoriel, ':idCategorie' => $categorieTutoriel));
    $sth->fetch();
}

/**
* Insère un nouvel abonnement
*
* Insère un nouvel abonnement dans la table 'abonnement'
*
* @param int ID du tutoriel
* @param int ID de l'utilisateur
*/
function InsererAbonnement($idTutoriel, $idUtilisateur){
    //Construire la requête
    $sql = "INSERT INTO `abonnement` (`id`, `idTutoriel`, `idUtilisateur`) VALUES (null, :idTutoriel, :idUtilisateur)";
    //La préparer
    $sth = connecteur()->prepare($sql);
    //L'exécuter
    $sth->execute(array(':idTutoriel' => $idTutoriel, ':idUtilisateur' => $idUtilisateur));
    $sth->fetch();
}

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

/**
* Met à jour un tutoriel
*
* Récupère les informations entrées par l'utilisateur et met le tutoriel à jour dans la base
*
* @param int ID du tutoriel
* @param string Titre du tutoriel
* @param string Contenu du tutoriel
* @param int ID de la catégorie du tutoriel
*/
function MajTutoriel($id, $titreTutoriel, $contenuTutoriel, $categorieTutoriel){
    //Construire la requête
    $sql = "UPDATE " . DB_NAME . ".`tutoriel` SET `titre` = :titre, `contenu` = :contenu, `idCategorie` = :categorieTutoriel WHERE `tutoriel`.`id` =:id";
    //La préparer
    $sth = connecteur()->prepare($sql);
    //L'exécuter
    $sth->execute(array(':titre' => $titreTutoriel, ':contenu' => $contenuTutoriel, ':categorieTutoriel' => $categorieTutoriel, ':id' => $id));
    $sth->fetch();
}

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
    //Construire la requête
    $sql = "DELETE FROM " . DB_NAME . ".`categorie` WHERE `id` = :id";
    //La préparer
    $sth = connecteur()->prepare($sql);
    //L'exécuter
    $sth->execute(array(':id' => $idCategorie));
    $sth->fetch();
}

/**
* Supprime un tutoriel
*
* Dans la table 'tutoriel', supprime le tutoriel correspondant à l'id reçu en paramètre
*
* @param int ID du tutoriel
*/
function SupprimerTutoriel($idTutoriel){
    //Construire la requête
    $sql = "DELETE FROM " . DB_NAME . ".`tutoriel` WHERE `id` = :id";
    //La préparer
    $sth = connecteur()->prepare($sql);
    //L'exécuter
    $sth->execute(array(':id' => $idTutoriel));
    $sth->fetch();
}

/**
* Supprime un abonnement
*
* Dans la table 'abonnement', supprime l'abonnement correspondant aux deux id
* reçu en paramètre (celui du tutoriel et celui de l'utilisateur)
*
* @param int ID du tutoriel
* @param int ID de l'utilisateur
*/
function SupprimerAbonnement($idTutoriel, $idUtilisateur){
    //Construire la requête
    $sql = "DELETE FROM " . DB_NAME . ".`abonnement` WHERE `idTutoriel` = :idTutoriel AND `idUtilisateur` = :idUtilisateur";
    //La préparer
    $sth = connecteur()->prepare($sql);
    //L'exécuter
    $sth->execute(array(':idTutoriel' => $idTutoriel, ':idUtilisateur' => $idUtilisateur));
    $sth->fetch();
}

//Fin

?>
