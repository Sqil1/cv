<?php
require_once 'header.php';
require_once 'database.php';
$bdd = connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];
    $password = $_POST["password"];

    // Vous devriez valider les données ici, par exemple, vérifier le nom d'utilisateur dans la base de données.

    // Exemple de vérification factice (à remplacer par une vérification réelle)
    $requete = $bdd->prepare("SELECT * FROM utilisateur WHERE user = :user");
    $requete->bindParam(':user', $user);
    $requete->execute();
    $resultat = $requete->fetch();

    if ($resultat && password_verify($password, $resultat['password'])) {
        // L'authentification a réussi
        $_SESSION["user"] = $user;
        header("Location: dashboard.php"); // Redirigez vers la page de tableau de bord
        exit();
    } else {
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
<section id="contact">
    <div class="title">
        <h2>Me contacter</h2>
    </div>
    <?php if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    } ?>
    <div id="from">
        <div class="from-box">
            <form action="meConnecter.php" method="post">
                <div class="row-form-contact">
                    <div class="col-form-contact">
                        <div class="from-group">
                            <label for="user">Nom d'utilisateur :</label>
                            <input type="text" name="user" id="user" class="from-control-contact" required>
                        </div>
                        <div class="from-group">
                            <label for="password">Mot de passe :</label>
                            <input type="password" name="password" id="password" class="from-control-contact" required>
                        </div>
                        <button type="submit">Se connecter</button>
            </form>
</body>
</html>
