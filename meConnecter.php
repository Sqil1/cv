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
<h2>Connexion</h2>
<?php if (isset($error_message)) {
    echo "<p style='color: red;'>$error_message</p>";
} ?>
<form action="meConnecter.php" method="post">
    <label for="user">Nom d'utilisateur :</label>
    <input type="text" name="user" id="user" required><br><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required><br><br>

    <input type="submit" value="Se connecter">
</form>
</body>
</html>
