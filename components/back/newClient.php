<?php
session_start();
if (empty($_SESSION)) {
    header('location: login.php');
}
if(isset($_POST['mail'],$_POST['password'],$_POST['name']) && !empty($_POST['password'])){
    require('../co_bdd.php'); 
    require('../function.php'); 
    $userFranchise = voirSiUsersExisteFranchises($bdd, $_POST['mail']); 
   
    $userEntreprise = voirSiUsersExisteEntreprise($bdd, $_POST['mail']); 
   
    $userStructure = voirSiUsersExisteStructures($bdd, $_POST['mail']);

    if(isset($_POST['checkActiveStructure']) && !empty($_POST['checkActiveStructure'])){
        $active = 1; 
    }else{
        $active = 0; 
    }

    if(!$userEntreprise && !$userFranchise && !$userStructure){
        $req =  "INSERT INTO franchises (name,mail,password,active,connexion,id_entreprise) VALUES (?,?,?,?,?,?)"; 
        $req = $bdd -> prepare($req); 
        $req -> execute([
            $_POST['name'],
            $_POST['mail'],
            password_hash($_POST['password'],PASSWORD_BCRYPT),
            $active,
            0,
            $_SESSION['id']
        ]); 

        $message = "Veuillez vous rendre sur le lien : 
        https://basicfrite.000webhostapp.com/login.php pour vous connecter.

        Mot de passe : " . $_POST["password"] . "
        Adresse de connexion : " . $_POST['mail'];
        mail($_POST['mail'],"Creation compte",$message); 
    
        header('location: ../../clients.php?success=clientsCreer'); 
    }else{
        header('location: ../../clients.php?error=emailExiste');
    }
}