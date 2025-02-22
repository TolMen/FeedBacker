<?php

/*
- Inclusion de fichier nécessaire
- Necessary file inclusion
*/
require_once dirname(__DIR__, 2) . '/model/LogModel/logWriteModel.php';
$config = require dirname(__DIR__, 3) . '/config/configBDD.php';

/*
- Extraction des paramètres de connexion de la BDD
- Extraction of database connection parameters
*/
$host = $config['host'];
$dbname = $config['dbname'];
$admin = $config['admin'];
$pass = $config['pass'];


try {

    /*
    - Création d'une instance PDO, puis utilise les paramètres de configuration de la BDD, puis gère le lancement d'exception en cas d'erreur
    - Create a PDO instance, then use the database configuration parameters, then handle exception throwing in case of error
    */
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8;", $admin, $pass);

    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    /*
    - Si échec, l'exception est déclenche pour enregistrer un message d'erreur dans les logs, puis arrête le script pour éviter d'aller dans les pages du site
    - If failure, the exception is triggered to record an error message in the logs, then stops the script to avoid going to the site pages
    */
    $logWrite = new LogWriteModel();
    $message = "ERREUR Base de données indisponible : " . $e->getMessage() . PHP_EOL . PHP_EOL;
    $logWrite->writeLog($message, "LogFiles/error.log");
    throw new Exception("Base de données indisponible");
}
