<?php

/* 
- Inclusion des fichiers nécessaire
- Inclusion of necessary files
*/
require_once '../../model/userModel/userOtherModel.php';

/*
- Crée une instance de classe, puis récupère la liste des utilisateurs
- Create an instance of the class, then retrieve the list of users
*/
$listUserModel = new UserOtherModel();
$recupListUser = $listUserModel->getAllUser($bdd);

/*
- Boucle pour chaque utilisateurs récupéré afin de les afficher dans une structure HTML
- Loop to display each user in an HTML structure
*/
foreach ($recupListUser as $user) {
?>
    <p><?= $user['first_name']; ?> <?= $user['name']; ?> --> Pseudo : <?= $user['pseudo']; ?>
        <a href="../../controller/userController/userDelete.php?id=<?= $user['id']; ?>"><i class="fa-solid fa-trash"></i></a>
    </p>
<?php
}
