<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg" style="background-color: #181118; border-bottom: 2px solid #5E3061;">
    <div class="container-fluid">
        <span class="navbar-brand text-light">FeedBacker</span>
        <?php if (!empty($_SESSION['id'])) { ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <a class="nav-link" href="home.php" style="color: <?php echo ($current_page == 'home.php') ? '#E796F3' : 'white'; ?>;">Accueil</a>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #FF9592;" href="../../controller/userController/userStop.php" title="Déconnexion">Déconnexion</a>
                    </li>
                <?php } ?>
                </ul>
            </div>
    </div>
</nav>