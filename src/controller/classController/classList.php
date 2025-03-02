<?php

/* 
- Inclusion des fichiers nécessaire
- Inclusion of necessary files
*/
require_once '../../model/classModel/classOtherModel.php';

/*
- Crée une instance de classe, puis récupère la liste des utilisateurs
- Create a class instance, then retrieve the list of classes
*/
$listClassModel = new ClassOtherModel();
$classList = $listClassModel->getAllClass($bdd);
