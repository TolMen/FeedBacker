<?php

/*
- Inclusion de fichier nécessaire
- Necessary file inclusion
*/
require_once '../../controller/BDDController/connectBDD.php';

/*
- Classe pour gérer des fonctions diverses sur les classes
- Class to manage various functions on classes
*/
class ClassOtherModel
{

    /*
    - Cette fonction récupère toutes les informations de toute les classes
    - This function retrieves all information from all classes
    */
    public function getAllClass(PDO $bdd)
    {
        $recupAllClass = $bdd->prepare('SELECT * FROM class');
        $recupAllClass->execute();
        return $recupAllClass->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    - Cette fonction récupère les informations utilisateurs par son ID
    - This function retrieves user information by ID
    */
    public function getDeleteClass(PDO $bdd, $classID)
    {
        $recupDeleteClass = $bdd->prepare('SELECT * FROM class WHERE id = ?');
        $recupDeleteClass->execute([$classID]);
        return $recupDeleteClass->fetch();
    }

    /*
    - Cette fonction supprimer les informations utilisateurs et met à jour le nombre d'élève
    - This function deletes user information and updates the number of students
    */
    public function deleteClass(PDO $bdd, $classId)
    {
        $deleteUser = $bdd->prepare('DELETE FROM class WHERE id = ?');
        return $deleteUser->execute([$classId]);
    }
}
