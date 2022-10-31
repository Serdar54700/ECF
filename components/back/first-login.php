<?php
session_start();
if (isset($_POST['mail'], $_POST['password']) && !empty($_POST['mail']) && !empty($_POST['password'])) {
    require('../co_bdd.php');

    $req = "SELECT * FROM structures WHERE mail = ?";
    $req = $bdd->prepare($req);
    $req->execute([$_POST['mail']]);
    $userStructure = $req->fetch();

    $req = "SELECT * FROM franchises WHERE mail = ?";
    $req = $bdd->prepare($req);
    $req->execute([$_POST['mail']]);
    $userFranchise = $req->fetch();

    if ($userFranchise && $userFranchise['active'] == 1) {

        $req = "UPDATE  franchises SET password= ?,connexion = ? WHERE id = ?"; 
        $req = $bdd -> prepare($req); 
        $req -> execute([
            password_hash($_POST['password'],PASSWORD_BCRYPT),
            1,
            $userFranchise['id']
        ]);

            
            $_SESSION['id'] = $userFranchise['id'];
            $_SESSION['mail'] = $userFranchise['mail'];
            $_SESSION['niveau'] = "Franchise";
            header('location: ../../index.php');
        
    }elseif ($userStructure && $userStructure['active'] == 1) {
     

            $req = "UPDATE structures SET password= ?,connexion = ? WHERE id = ?";
            $req = $bdd->prepare($req);
            $req->execute([
                password_hash($_POST['password'], PASSWORD_BCRYPT),
                1,
            $userStructure['id']
            ]);


            $_SESSION['id'] = $userFranchise['id'];
            $_SESSION['mail'] = $userFranchise['mail'];
            $_SESSION['niveau'] = "Franchise";
            header('location: ../../index.php');
        
    }
    else {
        header('location: ../../login.php');
    }
}
