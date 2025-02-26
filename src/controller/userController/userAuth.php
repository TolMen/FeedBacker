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
require_once '../../model/userModel/userAuthModel.php';
require_once '../../model/userModel/userSecurityModel.php';
require_once '../../model/logModel/logWriteModel.php';

/*
- Vérifie si le formulaire est soumis, puis si les champs sont vide
- Check if the form is submitted, and if the fields are empty
*/
if (isset($_POST['connexion'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {

        /*
        - Sécurisation et récupération des données
        - Security and data retrieval
        */
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = $_POST['password'];

        /*
        - Nouvelle instance de la classe de sécurité
        - New instance of the security class
        */
        $securityAccount = new SecurityAccount;

        /*
        - Appel de la fonction de vérification
        - Call of the verification function
        */
        $errorsSecurAccount = $securityAccount->checkSecurityAccount($pseudo, $password);

        /*
        - Si variables errors vide, on crée une instance du modèle de la classe
        - If variables errors empty, we create an instance of the model class
        */
        if (empty($errorsSecurAccount)) {
            $userAuthModel = new UserAuthModel();

            /*
            - Récupère le pseudo fourni
            - Retrieves the provided pseudo
            */
            $dataAuthUser = $userAuthModel->getAuthUser($bdd, $pseudo, $password);

            /*
            - Vérifie la présence du pseudo, puis si le MDP correspond au MDP haché dans la BDD
            - Check if the pseudo exists, and if the password matches the hashed password in the database
            */
            if ($dataAuthUser) {
                /*
                - Stock les informations dans des variables de session
                - Store the information in session variables
                */
                $_SESSION['id'] = $dataAuthUser['id'];
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['role'] = $dataAuthUser['role'];

                /*
                - Gestion des logs par un message et un appel de fonction
                - Logs management by a message and a function call
                */
                $logWrite = new LogWriteModel();
                $message = "ID : {$_SESSION['id']} = Connexion réussie pour l'utilisateur au pseudo '{$_SESSION['pseudo']}' ({$_SESSION['role']}) - " . date("d-m-Y H:i:s") . PHP_EOL . PHP_EOL;
                $logWrite->writeLog($message, "../../../logFiles/login.log");

                /*
                - Redirection vers la page d'accueil des utilisateurs
                - Redirect to the user's home page
                */
                header('Location: test.php');
                throw new Exception("Redirection vers la page ??");
            } else {
                echo 'Erreur lors de la connexion.';
            }
        } else {
            echo '$errorsSecurAccount';
        }
    }
} else {
    /*
        - Si échecs, retourne au formulaire
        - If failures, return to the form
        */
    header('Location: ../../views/form/loginForm.php');
    throw new Exception("Retourne au formulaire");
}
