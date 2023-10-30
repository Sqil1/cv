<?php


//$experience = null;
//$format_date_debut = new DateTime($experience['date_debut']);
//$date_debut = $format_date_debut->format('m-Y');

function isUserAuthenticated() {
    return isset($_SESSION['user']); // Vérifiez si l'utilisateur est authentifié
}