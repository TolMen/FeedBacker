<?php

/* 
- Reprend une session existante
- Resumes an existing session
*/
session_name("main");
session_start();

/* 
- Inclusion des fichiers nécessaires
- Inclusion of necessary files
*/
require_once '../../model/classModel/classOtherModel.php';
require_once '../../model/logModel/logWriteModel.php';

/*
- Vérifie si la requête est bien de type POST et que les données attendues sont présentes
- Checks if the request is POST and the expected data is available
*/
if (isset($_POST['class_id'], $_POST['class_name'])) {

    /*
    - Récupère l'ID de la classe et le nouveau nom
    - Retrieves the class ID and the new name
    */
    $classID = $_POST['class_id'];
    $newClassName = trim($_POST['class_name']);

    /*
    - Vérifie que le nouveau nom n'est pas vide avant de procéder à la mise à jour
    - Ensures the new name is not empty before updating
    */
    if (!empty($newClassName)) {

        /*
        - Crée une instance du modèle et récupère les informations de la classe
        - Creates an instance of the model and retrieves class information
        */
        $classModel = new ClassOtherModel();
        $existingClass = $classModel->getClassById($bdd, $classID);

        /*
        - Vérifie si la classe existe avant de la mettre à jour
        - Checks if the class exists before updating it
        */
        if ($existingClass) {
            if ($classModel->updateClass($bdd, $classID, $newClassName)) {

                /*
                - Redirection vers la page du tableau de bord après modification
                - Redirects to the dashboard page after modification
                */
                header('Location: ../../views/page/dashboard.php');
                exit();
            } else {
                echo "Erreur lors de la mise à jour de la classe.";
            }
        } else {
            echo "Classe introuvable.";
        }
    } else {
        echo "Le nom de la classe ne peut pas être vide.";
    }
} else {
    echo "Données invalides.";
}
