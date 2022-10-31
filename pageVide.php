<?php
session_start();
var_dump($_SESSION);
require('./components/header.php'); ?>
<div id="wrapper">

    <?php require('./components/nabargauche.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <?php require('./components/navbar.php') ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>


                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
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