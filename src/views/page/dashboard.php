<?php
session_name("main");
session_start();

require_once '../../controller/classController/classList.php';
require_once '../../controller/controlController/controlList.php';
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
        <div class="d-flex mb-3">
            <a href="#" class="btn btn-secondary"><i class="fa-solid fa-file-pen"></i> Contrôle</a>
        </div>
        <div class="row">
            <div class="col-md-8">
                <!-- Existing classes section -->
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
                                            <button class='btn btn-secondary btn-sm text-white' data-bs-toggle="modal" data-bs-target="#modal-updateClass-<?= $class['id'] ?>" title="Modifier les informations de la classe">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <a href='../../controller/classController/classDelete.php?id=<?= $class['id'] ?>' class='btn btn-danger btn-sm' title="Supprimer la classe">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal window for the list of students -->
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

                                    <!-- Modal window to edit class information -->
                                    <div class="modal fade" id="modal-updateClass-<?= $class['id'] ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modifier la classe : <?= htmlspecialchars($class['class_name']) ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../../controller/classController/classUpdate.php" method="POST">
                                                        <input type="hidden" name="class_id" value="<?= $class['id'] ?>">
                                                        <div class="mb-3">
                                                            <label for="class_name_<?= $class['id'] ?>" class="form-label">Nom de la classe</label>
                                                            <input type="text" class="form-control" id="class_name_<?= $class['id'] ?>" name="class_name" value="<?= htmlspecialchars($class['class_name']) ?>" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Existing control section -->
                <div class="card controlMarge shadow-sm">
                    <div class="card-header bg-dark text-white">Controle existant</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nom du contrôle</th>
                                    <th>Moyenne générale</th>
                                    <th>Appréciations générales</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($controlList as $controls) { ?>
                                    <tr>
                                        <td><?= $controls['title'] ?></td>
                                        <td><?= $controls['total_score'] ?></td>
                                        <td><?= $controls['general_appreciation'] ?></td>
                                        <td>
                                            <button class='btn btn-secondary btn-sm text-white' data-bs-toggle="modal" data-bs-target="#modal-updateControl-<?= $controls['id'] ?>" title="Modifier les informations du contrôle">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <a href='../../controller/controlController/controlDelete.php?id=<?= $controls['id'] ?>' class='btn btn-danger btn-sm' title="Supprimer le contrôle">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Adding a class section -->
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">Ajouter une classe</div>
                    <div class="card-body">
                        <form action="../../controller/classController/classAdd.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nom de la classe</label>
                                <input type="text" class="form-control" id="class_name" name="class_name" value="Classe " required>
                            </div>
                            <button type="submit" name="add_class" class="btn btn-secondary w-100"><i class="fa-solid fa-school-circle-check"></i> Créer une classe</button>
                        </form>
                    </div>
                </div>

                <!-- Adding students section -->
                <div class="card addStudent shadow-sm">
                    <div class="card-header bg-dark text-white">Ajouter un élève</div>
                    <div class="card-body">
                        <form action="../../controller/classController/classAddStudent.php" method="POST">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Prénom de l'élève" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom de l'élève" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Classe</label>
                                <select class="form-control" id="class_id" name="class_id" required>
                                    <?php
                                    foreach ($classList as $class) { ?>
                                        <option value="<?= $class['id'] ?>">
                                            <?= $class['class_name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" name="add_student" class="btn btn-secondary w-100"><i class="fa-solid fa-user-plus"></i> Ajouter un élève</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer inclusion -->
    <?php include '../component/footer.php' ?>
</body>

</html>