<?php
session_start();
require('./components/co_bdd.php');
require('./components/function.php');

$structure = getOnlyStructure($bdd,$_SESSION['id']); 
require('./components/header.php'); ?>
<div id="wrapper">

    <?php require('./components/nabargauche.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <?php require('./components/navbar.php') ?>

           
            <div class="container-fluid">
                <h2 class="mt-3">Ma structure</h2>


                <style>
                    .bgla {
                        display: none;
                    }

                    .vff {
                        box-shadow: rgba(17, 17, 26, 0.05) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 0px 8px;
                    }
                </style>
          
                    <div class="card vff mb-3">

                        <div class="card-body">
                            <h5 class="card-title">Numéro de la structure : <?= htmlspecialchars($structure['id']) ?></h5>
                            <p class="card-text">Nom de la structure : <?= htmlspecialchars($structure['name']) ?></p>

                            <label class="switch">

                                <input type="checkbox" id="checkbox" <?php if ($_SESSION['niveau'] !== "Direction") {
                                                                            echo 'disabled';
                                                                        } ?> onchange="CheckStructure(this,<?= $structure['id'] ?>)" name="checkActiveStructure" <?php if ($structure['active'] == 1) {
                                                                                                                                                                        echo "checked";
                                                                                                                                                                    } ?>>


                                <span class="slider round"></span>

                            </label>
                            <p>
                                <a class="btn btn-primary btnfct">Fonctionnalités</a>
                            </p>
                        </div>
                        <div class="bgla">

                            <form id="formulaireModifStructure" action="./components/back/envoiStructure.php" method="post">
                                <input type="hidden" name="id" value="<?= $structure['id'] ?>">
                                <input type="hidden" name="id" value="<?= $structure['id_franchise'] ?>">
                                <div class="form-group mx-3 col-4">
                                    <label for="exampleInputEmail1">Nom de la structure</label>

                                    <input type="text" class="form-control" name="name" <?php if ($_SESSION['niveau'] !== "Direction") {
                                                                                            echo 'disabled';
                                                                                        } ?> value="<?= htmlspecialchars($structure['name']) ?>">
                                </div>
                                <div class="form-group mx-3 col-4">
                                    <label for="exampleInputEmail1">Adresse email</label>

                                    <input type="text" name="mail" class="form-control" <?php if ($_SESSION['niveau'] !== "Direction") {
                                                                                            echo 'disabled';
                                                                                        } ?> value="<?= htmlspecialchars($structure['mail']) ?>">
                                </div>
                                <div class="form-group col-8 mx-3 flex-b">
                                    <p>Boisson </p>
                                    <label class="switch">

                                        <input type="checkbox" class="checkbox" <?php if ($_SESSION['niveau'] !== "Direction") {
                                                                                    echo 'disabled';
                                                                                } ?> name="checkBoisson" <?php if ($structure['boissons'] == 1) {
                                                                                                                echo 'checked';
                                                                                                            } ?>>
                                        <span class="slider round"></span>

                                    </label>

                                </div>

                                <div class="form-group col-8 mx-3 flex-b">
                                    <p>Télévision</p>
                                    <label class="switch">

                                        <input type="checkbox" <?php if ($_SESSION['niveau'] !== "Direction") {
                                                                    echo 'disabled';
                                                                } ?> class="checkbox" <?php if ($structure['televisions'] == 1) {
                                                                                            echo 'checked';
                                                                                        } ?> name="checkTv">
                                        <span class="slider round"></span>

                                    </label>

                                </div>

                                <div class="form-group col-8 mx-3 flex-b">
                                    <p>Barre protéinée</p>
                                    <label class="switch">

                                        <input type="checkbox" <?php if ($_SESSION['niveau'] !== "Direction") {
                                                                    echo 'disabled';
                                                                } ?> class="checkbox" <?php if ($structure['barre_proteines'] == 1) {
                                                                                            echo 'checked';
                                                                                        } ?> name="checkBarre">
                                        <span class="slider round"></span>

                                    </label>

                                </div>
                                <div class="form-group col-8 mx-3 flex-b">
                                    <p>Personnel ménager</p>
                                    <label class="switch">

                                        <input type="checkbox" class="checkbox" <?php if ($_SESSION['niveau'] !== "Direction") {
                                                                                    echo 'disabled';
                                                                                } ?> <?php if ($structure['personnel_menage'] == 1) {
                                                                                            echo 'checked';
                                                                                        } ?> name="checkMenage">
                                        <span class="slider round"></span>

                                    </label>

                                    <?php if ($_SESSION['niveau'] == "Direction") { ?>

                                        <input class="form-group" type="submit">
                                    <?php  } ?>
                            </form>


                        </div>
                    </div>
            </div>
     

       

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<?php require('./components/footer.php') ?>