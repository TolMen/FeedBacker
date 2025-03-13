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
require_once '../../model/userModel/userAddModel.php';
require_once '../../model/logModel/logWriteModel.php';

if (isset($_POST['add_student'])) {

    /*
    - Sécurisation des données
    - Data security
    */
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $name = htmlspecialchars(trim($_POST['name']));
    $class_id = $_POST['class_id'];

    /*
    - Génération automatique du pseudo : 1ère lettre du prénom + nom (en minuscule)
    - Automatic pseudo generation: first letter of first name + last name (all lowercase)
    */
    $pseudo = strtolower(substr($first_name, 0, 1) . $name);


    /*
    - Enregistrement de l'élève dans la base de données avec ses informations
    - Register the student in the database with their information
    */
    $studentAddModel = new UserAddModel();
    if ($studentAddModel->insertStudent($bdd, $first_name, $name, $pseudo, $class_id)) {

        /*
        - Gestion des logs par un message et un appel de fonction
        - Logs management by a message and a function call
        */
        $logWrite = new LogWriteModel();
        $message = "Ajout réussie pour l'élève au pseudo '$pseudo' - " . date("d-m-Y H:i:s") . PHP_EOL . PHP_EOL;
        $logWrite->writeLog($message, "../../../logFiles/addStudent.log");

        /*
        - Redirection vers le tableau de bord
        - Redirect to dashboard
        */
        header('Location: ../../views/page/dashboard.php');
        throw new Exception("Redirection vers le tableau de bord");
    }
}