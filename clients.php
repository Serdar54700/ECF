<?php
session_start();
if (empty($_SESSION)) {
    header('location: login.php');
}
if ($_SESSION['niveau'] == "Structure") {
    header('location: only_structure.php');
}
if ($_SESSION["niveau"] == "Franchise") {
    header('location: client.php?id=' . $_SESSION['id']);
}
require('./components/co_bdd.php');
require('./components/function.php');
$getListClients = getListClients($bdd, $_SESSION['id']);

require('./components/header.php'); ?>
<div id="wrapper">


    <?php require('./components/nabargauche.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <?php require('./components/navbar.php') ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?php if ($_SESSION['niveau'] == "Direction") { ?>
                    <h1 class="h3 mb-4 text-gray-800">Listes de nos clients</h1>
                    <button class="btnActive btn btn-primary mb-3">Actif</button>
                    <button class="btnNonActive btn btn-danger mb-3">Non actif</button>
                    <button class="btnTout btn btn-success mb-3">Tout</button>
                <?php } ?>
                <?php foreach ($getListClients as $getListClient) : ?>
                    <div id="test<?= htmlspecialchars($getListClient['id']) ?>" class="card <?php if ($getListClient['active'] == 1) {
                                                                                                echo "ouiactive";
                                                                                            } ?> checkboxRecherche">
                        <h5 class="card-header name"><?= htmlspecialchars($getListClient['name']) ?></h5>
                        <div class="card-body">
                            <h5 class="card-title">Numéro du client : <?= htmlspecialchars($getListClient['id']) ?></h5>
                            <p class="card-text">

                                Adresse email : <?= htmlspecialchars($getListClient['mail']) ?>
                            </p>
                            <p>
                            <form action="">
                                <label class="switch">

                                    <input type="checkbox" id="checkbox" class="checkboxInput" onchange="Check(this,<?= $getListClient['id'] ?>)" name="checkActiveStructure" <?php if ($getListClient['active'] == 1) {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?>>
                                    <span class="slider round"></span>
                                </label>
                            </form>


                            </p>
                            <a href="./client.php?id=<?= $getListClient['id'] ?>" class="btn btn-primary">Voir le client</a>
                        </div>
                    </div>


                <?php endforeach; ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->


        <script>
            let inputCheck = document.querySelectorAll(".checkboxRecherche");
            let btnActive = document.querySelector('.btnActive');
            let btnTout = document.querySelector('.btnTout');

            let btnNonActive = document.querySelector('.btnNonActive');
            btnActive.addEventListener('click', () => {
                for (let i = 0; i < inputCheck.length; i++) {
                    if (inputCheck[i].classList.contains('ouiactive')) {
                        inputCheck[i].style.display = "block";
                    } else {
                        inputCheck[i].style.display = "none";
                    }

                }
            })

            btnNonActive.addEventListener('click', () => {
                for (let i = 0; i < inputCheck.length; i++) {
                    if (inputCheck[i].classList.contains('ouiactive')) {
                        inputCheck[i].style.display = "none";
                    } else {
                        inputCheck[i].style.display = "block";
                    }

                }
            })
            btnTout.addEventListener('click', () => {
                for (let i = 0; i < inputCheck.length; i++) {
                    if (inputCheck[i].classList.contains('ouiactive')) {
                        inputCheck[i].style.display = "block";
                    } else {
                        inputCheck[i].style.display = "block";
                    }

                }
            })
        </script>
    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->


<?php require('./components/footer.php') ?>