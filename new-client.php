<?php
session_start();

if (empty($_SESSION) ) {
    header('location: login.php');
}
if ($_SESSION["niveau"] !== "Direction") {
    header('location: clients.php');
}
require('./components/header.php'); ?>
<div id="wrapper">

    <?php require('./components/nabargauche.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <?php require('./components/navbar.php') ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Nouveau client</h1>

                <style>
                    .switch {
                        position: relative;
                        display: inline-block;
                        width: 60px;
                        height: 34px;
                    }

                    .switch input {
                        opacity: 0;
                        width: 0;
                        height: 0;
                    }

                    .slider {
                        position: absolute;
                        cursor: pointer;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background-color: #ccc;
                        -webkit-transition: .4s;
                        transition: .4s;
                    }

                    .slider:before {
                        position: absolute;
                        content: "";
                        height: 26px;
                        width: 26px;
                        left: 4px;
                        bottom: 4px;
                        background-color: white;
                        -webkit-transition: .4s;
                        transition: .4s;
                    }

                    input:checked+.slider {
                        background-color: #2196F3;
                    }

                    input:focus+.slider {
                        box-shadow: 0 0 1px #2196F3;
                    }

                    input:checked+.slider:before {
                        -webkit-transform: translateX(26px);
                        -ms-transform: translateX(26px);
                        transform: translateX(26px);
                    }

                    /* Rounded sliders */
                    .slider.round {
                        border-radius: 34px;
                    }

                    .slider.round:before {
                        border-radius: 50%;
                    }
                </style>

                <form method="POST" action="./components/back/newClient.php">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nom de la structure</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter nom structure">

                    </div>
                   
                    <div class="form-group">
                        <label for="exampleInputEmail1">Adresse email</label>
                        <input type="email" class="form-control" name="mail" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-check">
                        <p>Activé :
                            <label class="switch">
                                <input type="checkbox" id="checkbox" name="checkActiveStructure">
                                <span class="slider round"></span>
                            </label>
                        </p>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<?php require('./components/footer.php') ?>