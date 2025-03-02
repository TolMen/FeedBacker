<?php
session_name("main");
session_start();

require_once '../../controller/classController/classList.php';
require_once '../../model/userModel/userOtherModel.php';
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

    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-3">
                    <a href="#" class="btn btn-dark" style="margin-right: 5px;"><i class="fa-solid fa-circle-plus"></i> Classe</a>
                    <a href="#" class="btn btn-secondary"><i class="fa-solid fa-file-pen"></i> Contrôle</a>
                </div>
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">Classes existantes</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nom de la classe</th>
                                    <th>Nombre d'élèves</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($classList as $class) {
                                    // Collect students from the current class
                                    $listUserModel = new UserOtherModel();
                                    $recupUserClass = $listUserModel->getUserClass($bdd, $class['id']);
                                ?>
                                    <tr>
                                        <td><?= $class['class_name'] ?></td>
                                        <td><?= $class['nb_student'] ?></td>
                                        <td>
                                            <button class='btn btn-info btn-sm text-white' data-bs-toggle="modal" data-bs-target="#modal-students-<?= $class['id'] ?>" title="Voir les élèves de la classe">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <a href='#?id=<?= $class['id'] ?>' class='btn btn-secondary btn-sm' title="Modifier les informations de la classe">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <a href='delete_class.php?id=<?= $class['id'] ?>' class='btn btn-danger btn-sm' title="Supprimer la classe">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal window -->
                                    <div class="modal fade" id="modal-students-<?= $class['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $class['id'] ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel<?= $class['id'] ?>">Liste des élèves - <?= $class['class_name'] ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class='list-group'>
                                                        <?php if (!empty($recupUserClass)) {
                                                            foreach ($recupUserClass as $student) { ?>
                                                                <li class='list-group-item d-flex justify-content-between align-items-center'>
                                                                    <?= $student['first_name'] . " " . $student['name'] ?>
                                                                    <a href='../../controller/userController/userDelete.php?id=<?= $student['id'] ?>' class='btn btn-danger btn-sm' title="Retirer l'élève de la classe">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </a>
                                                                </li>
                                                            <?php }
                                                        } else { ?>
                                                            <li class='list-group-item'>Aucun élève dans cette classe</li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer inclusion -->
    <?php include '../component/footer.php' ?>
</body>

</html>