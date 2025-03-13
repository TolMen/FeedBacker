<?php

/* 
- Reprend une session existante
- Resumes an existing session
*/
session_name("main");
session_start();

/* 
- Inclusion des fichiers nécessaire
- Inclusion of necessary files
*/
require_once '../../model/classModel/classOtherModel.php';
require_once '../../model/logModel/logWriteModel.php';

if (isset($_POST['add_class'])) {

    /*
    - Sécurisation des données
    - Data security
    */
    $class_name = htmlspecialchars($_POST['class_name']);

    /*
    - Enregistrement de l'élève dans la base de données avec ses informations
    - Register the student in the database with their information
    */
    $classAddModel = new ClassOtherModel();
    if ($classAddModel->insertClass($bdd, $class_name)) {

        /*
        - Gestion des logs par un message et un appel de fonction
        - Logs management by a message and a function call
        */
        $logWrite = new LogWriteModel();
        $message = "Ajout réussie pour la '$class_name' - " . date("d-m-Y H:i:s") . PHP_EOL . PHP_EOL;
        $logWrite->writeLog($message, "../../../logFiles/addClass.log");

        /*
        - Redirection vers le tableau de bord
        - Redirect to dashboard
        */
        header('Location: ../../views/page/dashboard.php');
        throw new Exception("Redirection vers le tableau de bord");
    }
}
