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
require_once '../../model/userModel/userOtherModel.php';
require_once '../../model/logModel/logWriteModel.php';

/*
- Vérifie si un ID User a été passé dans l'URL et qu'il n'est pas vide
- Checks if a User ID has been passed in the URL and is not empty
*/
if (isset($_GET['id']) && !empty($_GET['id'])) {

    /*
    - Récupère l'ID User, puis crée une instance de classe, pour ensuite récupérer toutes les informations de l'utilisateur
    - Retrieves the User ID, creates an instance of the class, and then retrieves all the user
    */
    $userID = $_GET['id'];
    $userBanModel = new UserOtherModel();
    $user = $userBanModel->getDeleteUser($bdd, $userID);

    /*
    - Vérifie si l'utilisateur existe, puis tente de le supprimer par l'appel de fonction
    - Checks if the user exists, then tries to delete it by calling the function
    */
    if ($user) {
        if ($userBanModel->deleteUser($bdd, $userID)) {

            /*
            - Gestion des logs par un message et un appel de fonction
            - Logs management by a message and a function call
            */
            $logWrite = new LogWriteModel();
            $message = "ID : {$userID} = L'utilisateur a été supprimer avec succès - " . date("d-m-Y H:i:s") . PHP_EOL . PHP_EOL;
            $logWrite->writeLog($message, "../../../logFiles/userDelete.log");

            /*
            - Redirection vers la page actuel
            - Redirect to the current page
            */
            header('Location: ../../views/page/home.php');
            throw new Exception("Redirection vers la page actuel");
        } else {
            echo "Erreur lors de la suppression de l'utilisateur.";
        }
    } else {
        echo "Aucun membre n'a été trouvé.";
    }
} else {
    echo "L'identifiant n'a pas été récupéré.";
}
