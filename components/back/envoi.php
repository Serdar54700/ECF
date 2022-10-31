<?php

require('../co_bdd.php');

if ($_POST['check'] == 'true') {
    $req = $bdd -> prepare("SELECT mail FROM franchises WHERE id = ?"); 
    $req -> execute([$_POST['id']]); 
    $mail = $req -> fetch(); 

    $req = "UPDATE franchises SET active = ? WHERE id = ? ";
    $req = $bdd->prepare($req);
    $req->execute([
    1,
    $_POST['id']
    ]);


    $message = "Vous etes activé";
    mail($mail['mail'], "Modification permissions", $message); 

} elseif ($_POST['check'] == 'false') {
    $req = $bdd->prepare("SELECT mail FROM franchises WHERE id = ?");
    $req->execute([$_POST['id']]);
    $mail = $req->fetch();


    $req = "UPDATE franchises SET active = ? WHERE id = ? ";
    $req = $bdd->prepare($req);
    $req->execute([
        0,
        $_POST['id']
    ]);



    $message2 = "Vous etes désactivé";
    mail($_POST['mail'], "Modification permissions", $message2); 
}
