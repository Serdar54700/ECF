<?php
session_start();
if (isset($_POST['mail'], $_POST['password']) && !empty($_POST['mail']) && !empty($_POST['password']) && $_GET['session'] == "conn") {
    require('../co_bdd.php');

    $req = "SELECT * FROM entreprise WHERE mail = ?";
    $req = $bdd->prepare($req);
    $req->execute([$_POST['mail']]);
    $user = $req->fetch();

    $req = "SELECT * FROM structures WHERE mail = ?";
    $req = $bdd->prepare($req);
    $req->execute([$_POST['mail']]);
    $userStructure = $req->fetch();

    $req = "SELECT * FROM franchises WHERE mail = ?";
    $req = $bdd->prepare($req);
    $req->execute([$_POST['mail']]);
    $userFranchises = $req->fetch();

   
    if ($user) {
        
        if (password_verify($_POST['password'], $user['password'])) {
            
            $_SESSION['id'] = $user['id'];
            $_SESSION['mail'] = $user['mail'];
            $_SESSION['niveau'] = "Direction";
            header('Location: ../../index.php');
        }else{
            header('Location: ../../login.php?error=mdp');

        }
    } else if ($userFranchises && $userFranchises['active'] == 1) {
        

        if (password_verify($_POST['password'], $userFranchises['password'])) {

            if ($userFranchises['connexion'] == 0) {
                header('location: ../../first-login.php'); 
                exit;
            }else{
                $_SESSION['id'] = $userFranchises['id'];
                $_SESSION['mail'] = $userFranchises['mail'];
                $_SESSION['niveau'] = "Franchise";
                header('location: ../../index.php');
            }
        } else {
            header('Location: ../../login.php?error=mdp');
        }
    } else if($userStructure && $userStructure['active'] == 1) {
     
        if (password_verify($_POST['password'], $userStructure['password'])) {
            if ($userStructure['connexion'] == 0) {
                header('location: ../../first-login.php');
            }else{

                $_SESSION['id'] = $userStructure['id'];
                $_SESSION['mail'] = $userStructure['mail'];
                $_SESSION['niveau'] = "Structure";
                header('location: ../../index.php');
            }
        } else {
            header('Location: ../../logi.php?error=mdp');
        }
    }else{
        header('location: ../../login.php');

    }
} else {
    header('Location: ../../login.php?error=manqueLesChamps');
}
