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
    <link rel="stylesheet" href="../../../public/css/styleAccount/styleRegistForm.css">
    <title>Inscription</title>
</head>

<body>
    <!-- Form box -->
    <div class="box">
        <span class="borderLine"></span>
        <!-- Form -->
        <form method="POST" action="../../controller/userController/userRegist.php">
            <h2>Inscription</h2>
            <!-- Input fields -->
            <div class="boxIdentity">
                <div class="inputBox inputBoxIdentity">
                    <input type="text" name="first_name" pattern="[A-Za-zÀ-ÿ]+" maxlength="26" title="Le prenom peut contenir des lettres." autocomplete="off" required>
                    <span>Prénom</span>
                    <i></i>
                </div>
                <div class="inputBox inputBoxIdentity">
                    <input type="text" name="name" pattern="[A-Za-zÀ-ÿ]+" maxlength="26" title="Le nom peut contenir des lettres." autocomplete="off" required>
                    <span>Nom</span>
                    <i class="name"></i>
                </div>
            </div>
            <div class="inputBox inputBoxOther">
                <input type="password" name="password" pattern="[A-Za-zÀ-ÿ0-9.]+" maxlength="15" title="Le mot de passe doit contenir des lettres, des chiffres et uniquement le symboles POINT" autocomplete="off" required>
                <span>Mot de passe</span>
                <i></i>
            </div>
            <div class="inputBox inputBoxOther">
                <input type="password" name="confirmPassword" pattern="[A-Za-zÀ-ÿ0-9.]+" maxlength="15" autocomplete="off" required>
                <span>Confirmer votre mot de passe</span>
                <i></i>
            </div>
            <!-- End of Input fields -->
            <div class="links">
                <a href="loginForm.php">Connexion</a>
            </div>
            <input type="submit" name="inscription" value="S'inscrire">
        </form>
        <!-- End of Form -->
    </div>
    <!-- End of Form box -->
</body>

</html>