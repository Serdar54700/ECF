<?php
session_start();
if (empty($_SESSION)) {
    header('location: login.php');
}
if (isset($_POST['mail'], $_POST['password'])) {
    require('../co_bdd.php');
    require('../function.php');
    $userFranchise = voirSiUsersExisteFranchises($bdd, $_POST['mail']);

    $userEntreprise = voirSiUsersExisteEntreprise($bdd, $_POST['mail']);

    $userStructure = voirSiUsersExisteStructures($bdd, $_POST['mail']);

    if (!$userEntreprise && !$userFranchise && !$userStructure) {
        $req = "INSERT INTO structures (name,mail,password,active,connexion,id_franchise) VALUES (?,?,?,?,?,?)";
        $req = $bdd->prepare($req);
        $req->execute([
            $_POST['name'],
            $_POST['mail'],
            password_hash($_POST['password'], PASSWORD_BCRYPT),
            1,
            0,
            $_POST['id']
        ]);


        $lastId = $bdd->lastInsertId();


        $boisson = isset($_POST['checkBoisson']) ? 1 : 0;
        $tv = isset($_POST['checkTv']) ? 1 : 0;
        $barre = isset($_POST['checkBarre']) ? 1 : 0;
        $menage = isset($_POST['checkMenage']) ? 1 : 0;

        $req = "INSERT INTO fonctionnalites (boissons,televisions,barre_proteines,personnel_menage,id_structures) VALUES (?,?,?,?,?)";
        $req = $bdd->prepare($req);
        $req->execute([
            $boisson,
            $tv,
            $barre,
            $menage,
            $lastId
        ]);

        $req = "SELECT mail FROM franchises WHERE id = ?"; 
        $req = $bdd -> prepare($req); 
        $req -> execute([$_POST['id']]); 
        $mailFranchise = $req -> fetch(); 
         
        $message = "Veuillez vous rendre sur le lien : 
        https://basicfrite.000webhostapp.com/login.php pour vous connecter.

        Mot de passe : " . $_POST["password"] . "
        Adresse de connexion : " . $_POST['mail'];
        mail($_POST['mail'], "Creation compte", $message); 
    

        $messageFranchise = "Nouvelle structure viens d'etree creer";
        mail($mailFranchise['mail'], "Creation structure", $message); 

        header('location: ../../client.php?id=' . $_POST['id']);
    } else {
        header('location: ../../client.php?error=existe&id=' . $_POST['id']);
    }
}
