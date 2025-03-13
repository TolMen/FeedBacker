<?php

/* 
- Inclusion de fichier nécessaire
- Necessary file inclusion 
*/
require_once '../../controller/BDDController/connectBDD.php';

/* 
- Classe pour gérer des fonctions diverses sur les contrôles
- Class to manage various functions on controls
*/
class ControlOtherModel
{

    /* 
    - Cette fonction récupère toutes les informations de toutes les contrôles
    - This function retrieves all information from all controls 
    */
    public function getAllControl(PDO $bdd)
    {
        $recupAllControl = $bdd->prepare('SELECT * FROM control');
        $recupAllControl->execute();
        return $recupAllControl->fetchAll(PDO::FETCH_ASSOC);
    }

    /* 
    - Cette fonction récupère les informations d'une contrôle par son ID pour suppression
    - This function retrieves control information by ID for deletion 
    */
    public function getDeleteControl(PDO $bdd, $controlID)
    {
        $recupDeleteControl = $bdd->prepare('SELECT * FROM control WHERE id = ?');
        $recupDeleteControl->execute([$controlID]);
        return $recupDeleteControl->fetch();
    }

    /* 
    - Cette fonction supprime une contrôle de la base de données
    - This function deletes a control from the database 
    */
    public function deleteControl(PDO $bdd, $controlID)
    {
        $deleteControl = $bdd->prepare('DELETE FROM control WHERE id = ?');
        return $deleteControl->execute([$controlID]);
    }
}
