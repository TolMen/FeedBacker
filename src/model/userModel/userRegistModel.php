<?php

/*
- Inclusion de fichier nécessaire
- Necessary file inclusion
*/
require_once '../../controller/BDDController/connectBDD.php';

/*
- Classe pour gérer les opérations d'inscription
- Class to manage the registration operations
*/
class UserRegistModel
{

    /*
    - Cette fonction insère les informations utilisateurs
    - This function inserts user information
    */
    public function insertRegistUser(PDO $bdd, $first_name, $name, $passwordHash, $pseudo)
    {
        $role = 'eleve';
        $insertUser = $bdd->prepare('INSERT INTO user(first_name, name, password, pseudo, role) VALUES (?, ?, ?, ?, ?)');
        return $insertUser->execute([$first_name, $name, $passwordHash, $pseudo, $role]);
    }

    /*
    - Cette fonction récupère les informations utilisateurs
    - This function retrieves user information
    */
    public function getRegistUser(PDO $bdd, $pseudo, $passwordHash)
    {
        $recupUser = $bdd->prepare('SELECT * FROM user WHERE pseudo = ? AND password = ?');
        $recupUser->execute([$pseudo, $passwordHash]);
        return $recupUser->fetch();
    }
}
