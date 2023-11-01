<?php

require_once 'header.php';
require_once 'functions.php';

if (isUserAuthenticated()) {
    // L'utilisateur est connecté, affichez le message de bienvenue
    $user = $_SESSION["user"];
    $user = ucfirst($user);
    echo "<div class=\"welcome-user\">Bienvenue, $user!</div>";
} else {
    // L"utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: meConnecter.php");
    exit();
}
// message de suppression à faire
require_once 'experiences.php';
require_once 'ajouterExperience.php';
require_once 'cursus.php';
require_once 'ajouterCursus.php';