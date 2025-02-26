<?php
session_name("main");
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Inclusion of meta tags -->
    <?php include '../component/head.php'; ?>

    <!-- CSS -->
    <link rel="stylesheet" href="../../../public/css/styleAccount/styleIdemAccountForm.css">
    <link rel="stylesheet" href="../../../public/css/styleAccount/styleLoginForm.css">
    <title>Connexion</title>
</head>

<body>
    <!-- Form box -->
    <div class="box">
        <span class="borderLine"></span>
        <!-- Form -->
        <form method="POST" action="../../controller/userController/userAuth.php">
            <h2>Connexion</h2>
            <!-- Input fields -->
            <div class="inputBox inputBoxOther">
                <input type="text" name="pseudo" pattern="[a-z]+" maxlength="26" title="Votre pseudo = Première lettre de votre prénom + votre nom." autocomplete="off" required>
                <span>Pseudo</span>
                <i></i>
            </div>
            <div class="inputBox inputBoxOther">
                <input type="password" name="password" pattern="[A-Za-zÀ-ÿ0-9.]+" maxlength="15" title="Le mot de passe doit contenir des lettres, des chiffres et uniquement le symboles POINT" autocomplete="off" required>
                <span>Mot de passe</span>
                <i></i>
            </div>
            <!-- End of Input fields -->
            <div class="links">
                <!-- <a href="#">Forgotten password</a> -->
                <a href="registForm.php">Inscription</a>
            </div>
            <input type="submit" name="connexion" value="Se connecter">
        </form>
        <!-- End of Form -->
    </div>
    <!-- End of Form box -->
</body>

</html>