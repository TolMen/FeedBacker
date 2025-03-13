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
class UserAddModel
{

    /*
    - Cette fonction insère les informations utilisateurs
    - This function inserts user information
    */
    public function insertStudent(PDO $bdd, $first_name, $name, $pseudo, $class_id)
    {
        $role = 'eleve';
        $passwordOne = hash('sha256', $pseudo);
        $insertUser = $bdd->prepare('INSERT INTO user(first_name, name, password, pseudo, role, class_id) VALUES (?, ?, ?, ?, ?, ?)');
        $success = $insertUser->execute([$first_name, $name, $passwordOne, $pseudo, $role, $class_id]);

        if ($success && $class_id) {
            $updateNbStudent = $bdd->prepare('UPDATE class SET nb_student = nb_student + 1 WHERE id = ?');
            $updateNbStudent->execute([$class_id]);
        }
        return $success;
    }
}
