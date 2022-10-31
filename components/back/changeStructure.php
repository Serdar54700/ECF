<?php
session_start(); 
require('../co_bdd.php');

if ($_POST['check'] == 'true') {
    $req = "UPDATE structures SET active = ? WHERE id = ? ";
    $req = $bdd->prepare($req);
    $req->execute([
        1,
        $_POST['id']
    ]);
} elseif ($_POST['check'] == 'false') {

    $req = "UPDATE structures SET active = ? WHERE id = ? ";
    $req = $bdd->prepare($req);
    $req->execute([
        0,
        $_POST['id']
    ]);
}
