<?php
$current_page = basename($_SERVER['PHP_SELF']); // Récupère uniquement le nom du fichier actuel
?>

<nav class="navbar navbar-expand-lg" style="background-color: #181118; border-bottom: 2px solid #5E3061;">
    <div class="container-fluid">
        <span class="navbar-brand text-light">FeedBacker</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'home.php') ? 'active text-primary' : ''; ?>" href="home.php" style="color: white;">Accueil</a>
                </li>
                <?php if (!empty($_SESSION['userID'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #E796F3;" href="src/control/UserControl/logout.php" title="Déconnexion">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'login.php') ? 'active text-primary' : ''; ?>" href="login.php" style="color: white;">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'register.php') ? 'active text-primary' : ''; ?>" href="register.php" style="color: white;">Inscription</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>