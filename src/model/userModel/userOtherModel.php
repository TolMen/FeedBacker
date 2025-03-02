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
    - Cette fonction récupère toutes les informations de tout les utilisateurs d'une classe
    - This function retrieves all the information of all the users of a class
    */
    public function getUserClass(PDO $bdd, $classID)
    {
        $recupUserClass = $bdd->prepare('SELECT * FROM user WHERE class_id = ?');
        $recupUserClass->execute([$classID]);
        return $recupUserClass->fetchAll(PDO::FETCH_ASSOC);
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
    - Cette fonction supprimer les informations utilisateurs et met à jour le nombre d'élève
    - This function deletes user information and updates the number of students
    */
    public function deleteUser(PDO $bdd, $userId)
    {
        $recupClassId = $bdd->prepare('SELECT class_id FROM user WHERE id = ?');
        $recupClassId->execute([$userId]);
        $classId = $recupClassId->fetchColumn();

        $deleteUser = $bdd->prepare('DELETE FROM user WHERE id = ?');
        $success = $deleteUser->execute([$userId]);

        if ($success && $classId) {
            $updateNbStudent = $bdd->prepare('UPDATE class SET nb_student = nb_student - 1 WHERE id = ? AND nb_student > 0');
            $updateNbStudent->execute([$classId]);
        }

        return $success;
    }
}
