<?php
session_start();
require('./components/co_bdd.php');
require('./components/function.php');
$client = getClient($bdd, $_GET['id']);
$stuctures = getStructures($bdd, $_GET['id']);
if ($_SESSION['niveau'] === "Franchise" && $_SESSION['id'] !== $_GET['id']) {
    header('location: ./components/back/deconnexion.php');
}
if ($_SESSION['niveau'] == "Structure") {
    header('location: only_structure.php');
}

require('./components/header.php'); ?>
<div id="wrapper">

    <?php require('./components/nabargauche.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <?php require('./components/navbar.php') ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Client n° : <?= htmlspecialchars($client['id']); ?></h1>

                <div class="card">
                    <h5 class="card-header"><?= htmlspecialchars($client['name']); ?></h5>
                    <div class="card-body">
                        <h5 class="card-title"> <a href="mailto: <?= htmlspecialchars($client['mail']); ?>"> <?= htmlspecialchars($client['mail']); ?></a></h5>
                        <p class="card-text">Active :

                            <label class="switch">

                                <input type="checkbox" <?php if ($_SESSION['niveau'] !== "Direction") {
                                                            echo 'disabled';
                                                        } ?> id="checkbox" onchange="CheckE(this,<?= $client['id'] ?>)" name="checkActiveStructure" <?php if ($client['active'] == 1) {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } ?>>
                                <span class="slider round"></span>

                            </label>



                        </p>
                        <?php if ($_SESSION['niveau'] == "Direction") { ?>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Ajouter une structure
                            </button>
                        <?php } ?>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajout Structure</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="./components/back/newStructure.php">
                                            <input type="hidden" name="id" value="<?= $client['id'] ?>">
                                            <div class="form-group">

                                                <label for="exampleInputEmail1">Nom de la structure</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" placeholder="Nom de la structure">

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Adresse email</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mail" placeholder="Enter email">

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mot de passe</label>
                                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                            </div>


                                            <style>
                                                .flex-b {
                                                    display: flex;
                                                    justify-content: space-between;
                                                }
                                            </style>
                                            <div class="form-group flex-b">
                                                <p>Boisson </p>
                                                <label class="switch">

                                                    <input type="checkbox" id="checkbox" name="checkBoisson">
                                                    <span class="slider round"></span>

                                                </label>

                                            </div>

                                            <div class="form-group flex-b">
                                                <p>Télévision</p>
                                                <label class="switch">

                                                    <input type="checkbox" id="checkbox" name="checkTv">
                                                    <span class="slider round"></span>

                                                </label>

                                            </div>

                                            <div class="form-group flex-b">
                                                <p>Barre protéinée</p>
                                                <label class="switch">

                                                    <input type="checkbox" id="checkbox" name="checkBarre">
                                                    <span class="slider round"></span>

                                                </label>

                                            </div>
                                            <div class="form-group flex-b">
                                                <p>Personnel ménager</p>
                                                <label class="switch">

                                                    <input type="checkbox" id="checkbox" name="checkMenage">
                                                    <span class="slider round"></span>

                                                </label>

                                            </div>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <hr>

            <div class="container-fluid">
                <h2 class="mt-3">Liste des structures</h2>


                <style>
                    .bgla {
                        display: none;
                    }

                    .vff {
                        box-shadow: rgba(17, 17, 26, 0.05) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 0px 8px;
                    }
                </style>
                <?php foreach ($stuctures as $structure) :

                ?>
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
                                <input type="hidden" name="idFranchise" value="<?= $structure['id_franchise'] ?>">
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

                                        <input type="checkbox" class="check" <?php if ($_SESSION['niveau'] !== "Direction") {
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

                                        <input type="checkbox" class="check" <?php if ($_SESSION['niveau'] !== "Direction") {
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

                                        <input type="checkbox" class="check" <?php if ($_SESSION['niveau'] !== "Direction") {
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

                                        <input type="checkbox" class="check" <?php if ($_SESSION['niveau'] !== "Direction") {
                                                                                    echo 'disabled';
                                                                                } ?> <?php if ($structure['personnel_menage'] == 1) {
                                                                                            echo 'checked';
                                                                                        } ?> name="checkMenage">
                                        <span class="slider round"></span>

                                    </label>


                                    <input class="form-group" type="submit" value="enregistrer">

                            </form>


                        </div>
                    </div>
            </div>
        <?php endforeach;  ?>

        <script>
            let monCheck = document.querySelectorAll('.check');
            for (let i = 0; i < monCheck.length; i++) {

                monCheck[i].addEventListener("click", (e) => {
                    if (!confirm("Etes vous sur")) {
                        e.preventDefault();

                    }

                });

            }

            function CheckE(value, idClient) {
                let bg = value.checked;
                const data = new FormData();
                data.append('check', bg);
                data.append('id', idClient);
                const requeteAjax = new XMLHttpRequest();
                requeteAjax.open('POST', './components/back/envoi.php');
                requeteAjax.onload = function() {
                }
                requeteAjax.send(data);
            }

           
        </script>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<?php require('./components/footer.php') ?>