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
    <link rel="stylesheet" href="../../../public/css/styleProf/styleDashboard.css">
    <title>Tableau de bord</title>
</head>

<body>
    <!-- Including the navigation bar -->
    <?php include '../component/navbar.php' ?>

    <!-- List Users -->
    <section class="listUsers">
        <h2>
            Liste des éléves
        </h2>
        <div>
            <!-- Include the controller and avoid logic in the view -->
            <?php include '../../controller/userController/userList.php'; ?>
        </div>
    </section>
    <!-- End of List Users -->

    <!-- Footer inclusion -->
    <?php include '../component/footer.php' ?>

    <!-- Links to JavaScript scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>