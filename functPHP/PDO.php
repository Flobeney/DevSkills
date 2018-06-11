<?php

//Constantes
define("DB_HOST", "localhost");
define("DB_NAME", "TPI");
define("DB_USER", "beneyf");
define("DB_PASSWORD", "beneyf");
//Salt généré aléatoirement par la fonction openssl_random_pseudo_bytes
define("SALT", "b1cf170fa81a942c5c10046dd25f479cb0c9c2cb7680954e33c4151562d04a11");
//Définir le niveau d'erreur
error_reporting(E_ERROR);

/**
* La connexion à la base de données
*
* Cette fonction crée un objet PDO pour établir une connexion à la base de données
*
* @return objet une nouvelle instance de l'objet PDO
*/
function connecteur(){
    static $dbc = null;

    if ($dbc == null) {
        try{
            $dbc = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_PERSISTENT => TRUE));
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br/>';
            echo 'N° : ' . $e->getCode();
            die('Could not connect to MySQL');
        }
    }
    return $dbc;
}
