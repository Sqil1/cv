<?php
//var_dump($_POST);


$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];
$headers = "From: " . $email . "\r\n";
$toEmail = "mbadoian@gmail.com";


if (mail($toEmail, "Formulaire de contact", $message, $headers)) {
    header('Location: index.php?sendmail=success#contact');
} else {
    header('Location: index.php?sendmail=error#contact');
}

