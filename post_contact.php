<?php
//var_dump($_POST);


$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];
$headers = "From: " . $email . "\r\n";
$toEmail = "mbadoian@gmail.com";

if (empty($name) || empty($email) || empty($message)) {
    // Gérer le cas où des champs requis sont vides
    header('Location: index.php?sendmail=error#contact');
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Gérer le cas où l'e-mail n'a pas un format valide
    header('Location: index.php?sendmail=error#contact');
    exit;
}
// Nettoyage des données
$name = trim($name);
$email = trim($email);
$message = strip_tags($message);


if (mail($toEmail, "Formulaire de contact", $message, $headers)) {
    header('Location: index.php?sendmail=success#contact');
} else {
    header('Location: index.php?sendmail=error#contact');
}

