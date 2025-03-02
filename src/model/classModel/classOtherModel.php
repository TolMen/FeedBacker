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
}
