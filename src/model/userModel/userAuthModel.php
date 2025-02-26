<?php

/*
- Inclusion de fichier nécessaire
- Necessary file inclusion
*/
require_once '../../controller/BDDController/connectBDD.php';

/*
- Classe pour gérer les opérations de connexion
- Class to manage connection operations
*/
class UserAuthModel
{

    /*
    - Cette fonction récupère le pseudo des utilisateurs
    - This function retrieves the users' nickname
    */
    public function getAuthUser(PDO $bdd, $pseudo, $password)
    {
        $recupUser = $bdd->prepare('SELECT * FROM user WHERE pseudo = ? AND password = SHA2(?, 256)');
        $recupUser->execute([$pseudo, $password]);
        return $recupUser->fetch(PDO::FETCH_ASSOC);
    }
}
