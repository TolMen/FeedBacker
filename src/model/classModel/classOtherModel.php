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
    - Cette fonction récupère toutes les informations de toutes les classes
    - This function retrieves all information from all classes 
    */
    public function getAllClass(PDO $bdd)
    {
        $recupAllClass = $bdd->prepare('SELECT * FROM class');
        $recupAllClass->execute();
        return $recupAllClass->fetchAll(PDO::FETCH_ASSOC);
    }

    /* 
    - Cette fonction récupère les informations d'une classe par son ID
    - This function retrieves class information by ID 
    */
    public function getClassById(PDO $bdd, $classID)
    {
        $recupClass = $bdd->prepare('SELECT * FROM class WHERE id = ?');
        $recupClass->execute([$classID]);
        return $recupClass->fetch(PDO::FETCH_ASSOC);
    }

    /* 
    - Cette fonction récupère les informations d'une classe par son ID pour suppression
    - This function retrieves class information by ID for deletion 
    */
    public function getDeleteClass(PDO $bdd, $classID)
    {
        $recupDeleteClass = $bdd->prepare('SELECT * FROM class WHERE id = ?');
        $recupDeleteClass->execute([$classID]);
        return $recupDeleteClass->fetch();
    }

    /* 
    - Cette fonction supprime une classe de la base de données
    - This function deletes a class from the database 
    */
    public function deleteClass(PDO $bdd, $classID)
    {
        $deleteClass = $bdd->prepare('DELETE FROM class WHERE id = ?');
        return $deleteClass->execute([$classID]);
    }

    /* 
    - Cette fonction met à jour le nom d'une classe par son ID
    - This function updates the class name by ID 
    */
    public function updateClass(PDO $bdd, $classID, $newName)
    {
        $updateClass = $bdd->prepare('UPDATE class SET class_name = ? WHERE id = ?');
        return $updateClass->execute([$newName, $classID]);
    }


    /*
    - Cette fonction insère les informations utilisateurs
    - This function inserts user information
    */
    public function insertClass(PDO $bdd, $class_name)
    {
        $insertClass = $bdd->prepare('INSERT INTO class (class_name) VALUES (?)');
        $success = $insertClass->execute([$class_name]);

        return $success;
    }
}
