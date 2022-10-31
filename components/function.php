<?php 

function getListClients($bdd,$idSession){
    $rq = "SELECT * FROM franchises WHERE id_entreprise = ?";
    $statement = $bdd->prepare($rq);
    $statement->execute([$idSession]); 
    $listeFranchises = $statement -> fetchAll(); 
    return $listeFranchises; 
}

function getClient($bdd,$client){
    $req = "SELECT * FROM franchises WHERE id = ?"; 
    $statement = $bdd -> prepare($req); 
    $statement -> execute([
        $client
    ]); 
    $client = $statement -> fetch(); 
    return $client; 
}

function getStructures($bdd,$idFranchise){
    $rq = "SELECT structures.*,fonctionnalites.id as fctid,fonctionnalites.boissons,fonctionnalites.televisions,fonctionnalites.barre_proteines,fonctionnalites.personnel_menage,fonctionnalites.id_structures FROM structures INNER JOIN fonctionnalites ON fonctionnalites.id_structures = structures.id WHERE id_franchise = ?";
    $statement = $bdd->prepare($rq);
    $statement->execute([$idFranchise]);
    $listeFranchises = $statement->fetchAll();
    return $listeFranchises; 
}

function voirSiUsersExisteEntreprise($bdd,$mail){
    $req = "SELECT * FROM entreprise WHERE mail = ?";
    $req = $bdd->prepare($req);
    $req->execute([
        $mail
    ]);
    $siUsersExiste = $req->fetch();
    return $siUsersExiste; 
}

function voirSiUsersExisteStructures($bdd, $mail)
{
    $req = "SELECT * FROM structures WHERE mail = ?";
    $req = $bdd->prepare($req);
    $req->execute([
        $mail
    ]);
    $siUsersExiste = $req->fetch();
    return $siUsersExiste;
}

function voirSiUsersExisteFranchises($bdd, $mail)
{
    $req = "SELECT * FROM franchises WHERE mail = ?";
    $req = $bdd->prepare($req);
    $req->execute([
        $mail
    ]);
    $siUsersExiste = $req->fetch();
    return $siUsersExiste;
}


function getOnlyStructure($bdd, $idStructure)
{
    $rq = "SELECT structures.*,fonctionnalites.id as fctid,fonctionnalites.boissons,fonctionnalites.televisions,fonctionnalites.barre_proteines,fonctionnalites.personnel_menage,fonctionnalites.id_structures FROM structures INNER JOIN fonctionnalites ON fonctionnalites.id_structures = structures.id WHERE structures.id = ?";
    $statement = $bdd->prepare($rq);
    $statement->execute([$idStructure]);
    $structure = $statement->fetch();
    return $structure;
}