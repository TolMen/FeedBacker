<?php

/*
- Inclusion de fichier nécessaire
- Necessary file inclusion
*/
require_once '../../controller/BDDController/connectBDD.php';

/*
- Classe pour gérer des fonctions diverses sur les utilisateurs
- Class to manage various functions on users
*/
class UserOtherModel
{

    /*
    - Cette fonction récupère toutes les informations de tout les utilisateurs
    - This function retrieves all information from all users
    */
    public function getAllUser(PDO $bdd)
    {
        $recupAllUser = $bdd->prepare('SELECT * FROM user');
        $recupAllUser->execute();
        return $recupAllUser->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    - Cette fonction récupère les informations utilisateurs par son ID
    - This function retrieves user information by ID
    */
    public function getDeleteUser(PDO $bdd, $userID)
    {
        $recupDeleteUser = $bdd->prepare('SELECT * FROM user WHERE id = ?');
        $recupDeleteUser->execute([$userID]);
        return $recupDeleteUser->fetch();
    }

    /*
    - Cette fonction supprime les informations utilisateurs
    - This function deletes user information
    */
    public function deleteUser(PDO $bdd, $userId)
    {
        $deleteUser = $bdd->prepare('DELETE FROM user WHERE id = ?');
        return $deleteUser->execute([$userId]);
    }
}
