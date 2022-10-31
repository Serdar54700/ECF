<?php
session_start();
if (empty($_SESSION)) {
    header('location: login.php');
}


if(isset($_POST['name'],$_POST['mail'])){
    require('../co_bdd.php');
    $boisson = isset($_POST['checkBoisson']) ? 1 : 0;
    $tv = isset($_POST['checkTv']) ? 1 : 0;
    $barre = isset($_POST['checkBarre']) ? 1 : 0;
    $menage = isset($_POST['checkMenage']) ? 1 : 0; 


    $req = "UPDATE structures set name= ?,mail = ? WHERE id = ?"; 
    $req = $bdd -> prepare($req); 
    $req -> execute([
        $_POST['name'],
        $_POST['mail'], 
        $_POST['id']
    ]);


    $req = "UPDATE fonctionnalites set boissons= ?,televisions = ?,barre_proteines = ?, personnel_menage = ? WHERE id_structures = ?";
    $req = $bdd->prepare($req);
    $req->execute([
        $boisson,
        $tv,
        $barre,
        $menage,
        $_POST['id']
    ]);

    header('location: ../../client.php?id=' . $_POST['idFranchise']);
}


