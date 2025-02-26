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
require_once '../../model/userModel/userRegistModel.php';
require_once '../../model/logModel/logWriteModel.php';
require_once '../../model/userModel/userSecurityModel.php';

/*
- Vérifie si le formulaire est soumis, puis si les champs sont vide
- Check if the form is submitted, and if the fields are empty
*/
if (isset($_POST['inscription'])) {
    if (!empty($_POST['first_name']) && !empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['confirmPassword'])) {

        /*
        - Sécurisation des données
        - Data security
        */
        $first_name = htmlspecialchars(trim($_POST['first_name']));
        $name = htmlspecialchars(trim($_POST['name']));
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        /*
        - Vérification si les mots de passe correspondent
        - Check if passwords match
        */
        if ($password !== $confirmPassword) {
            echo "Les mots de passe ne correspondent pas.";
            exit;
        }

        /*
        - Génération automatique du pseudo : 1ère lettre du prénom + nom (en minuscule)
        - Automatic pseudo generation: first letter of first name + last name (all lowercase)
        */
        $pseudo = strtolower(substr($first_name, 0, 1) . $name);

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
            /*
        - Hashage du mot de passe en SHA2(256)
        - Hash the password using SHA2(256)
        */
            $passwordHash = hash('sha256', $password);
            $userRegistModel = new UserRegistModel();

            /*
            - Enregistre l'utilisateur, récupère ses informations, puis vérifie sa présence dans la BDD
            - Register the user, retrieve his information, then check his presence in the database
            */
            if ($userRegistModel->insertRegistUser($bdd,$first_name, $name, $passwordHash, $pseudo)) {

                $user = $userRegistModel->getRegistUser($bdd, $pseudo, $passwordHash);

                if ($user) {
                    /*
                    - Stock les informations dans des variables de session
                    - Store the information in session variables
                    */
                    $_SESSION['pseudo'] = $pseudo;
                    $_SESSION['id'] = $user['id'];
                }

                /*
                - Gestion des logs par un message et un appel de fonction
                - Logs management by a message and a function call
                */
                $logWrite = new LogWriteModel();
                $message = "ID : {$_SESSION['id']} = Inscription réussie pour l'utilisateur au pseudo '{$_SESSION['pseudo']}' - " . date("d-m-Y H:i:s") . PHP_EOL . PHP_EOL;
                $logWrite->writeLog($message, "../../../logFiles/regist.log");

                /*
                - Redirection vers la page d'accueil des utilisateurs
                - Redirect to the user's home page
                */
                header('Location: test.php');
                throw new Exception("Redirection vers la page ??");
            }
        } else {
            echo '$errorsSecurAccount';
        }
    } else {
        /*
        - Si échecs, retourne au formulaire
        - If failures, return to the form
        */
        header('Location: ../../views/form/registForm.php');
        throw new Exception("Retourne au formulaire");
    }
}
