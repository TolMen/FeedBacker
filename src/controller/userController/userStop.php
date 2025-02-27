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
require_once '../BDDController/connectBDD.php';
require_once '../../model/logModel/logWriteModel.php';

/*
- Réinitialise les variables, puis détruit la session
- Resets variables, then destroys the session
*/
$_SESSION = array();
session_destroy();

/*
- Gestion des logs par un message et un appel de fonction
- Logs management by a message and a function call
*/
$logWrite = new LogWriteModel();
$message = "Info : Déconnexion réussie pour un utilisateur " . date("d-m-Y H:i:s") . PHP_EOL . PHP_EOL;
$logWrite->writeLog($message, "../../../logFiles/logout.log");

/*
- Redirection vers la page de connexion
- Redirect to login page
*/
header('Location: ../../views/form/loginForm.php');
throw new Exception("Redirection vers la page de connexion");
