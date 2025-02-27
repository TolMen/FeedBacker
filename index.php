<?php

/*
- Démarre une session
- Start a session
*/
session_name("main");
session_start();

/*
- Inclusion de fichier nécessaire
- Necessary file inclusion
*/
require_once 'src/controller/BDDController/connectBDD.php';

/*
- Vérifie les paramètres après ? dans l'URL, si vide redirection vers la page de connexion
- Check the settings afterwards? in URL, if empty redirect to login page
*/
if (empty($_SERVER['QUERY_STRING'])) {
    header("Location: src/views/form/loginForm.php");
    throw new Exception("Redirection vers la page de connexion.");
}
