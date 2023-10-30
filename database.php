<?php
function connect()
{
    $host = "localhost";
    $dbname = "cv";
    $username = "root";
    $password = "";


    try {
        $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bdd; // Retourne l'objet PDO
    } catch (PDOException $exception) {
        die("Erreur : " . $exception->getMessage());
    }
}

