<?php
// Démarrez la session
session_start();

// Destruction des variables de session
session_unset();

// Détruisez la session
session_destroy();

// Redirigez l'utilisateur vers la page de connexion ou une autre page
header("Location: index.php");
exit();
