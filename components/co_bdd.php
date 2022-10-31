<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

try {
    $bdd = new PDO('mysql:host=localhost;dbname=salle;charset=UTF8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
