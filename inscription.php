<?php
session_start();
require_once './database.php';
$bdd = connect();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises par le formulaire
    $user = $_POST["user"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $admin = $_POST["admin"];

    // Validez les données d'inscription (vérifiez les champs vides, la validité du nom d'utilisateur, etc.)

    // Assurez-vous que le mot de passe et la confirmation correspondent
    if ($password != $confirm_password) {
        $error_message = "Les mots de passe ne correspondent pas.";
    } else {
        // Vous devriez hacher et saler le mot de passe ici avant de le stocker dans la base de données.

        // Exemple de stockage factice (à remplacer par un stockage réel)
        // Assurez-vous d'utiliser des techniques de hachage sécurisées
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Enregistrez l'utilisateur dans la base de données

        $requeteInscription = $bdd->prepare("INSERT INTO utilisateur (user, password, admin) VALUES (:user, :password, :admin)");
        $requeteInscription->bindParam(':user', $user);
        $requeteInscription->bindParam(':password', $hashed_password);
        $requeteInscription->bindParam(':admin', $admin);
        $requeteInscription->execute();

        // Redirigez l'utilisateur vers la page de connexion après l'inscription
        header("Location: meConnecter.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>
<h2>Inscription</h2>
<?php if (isset($error_message)) {
    echo "<p style='color: red;'>$error_message</p>";
} ?>
<form action="inscription.php" method="post">
    <label for="user">Nom d'utilisateur :</label>
    <input type="text" name="user" id="user" required><br><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required><br><br>

    <label for="confirm_password">Confirmer le mot de passe :</label>
    <input type="password" name="confirm_password" id="confirm_password" required><br><br>

    <label for="admin">Administrateur :</label>
    <select name="admin">
        <option value="oui">Oui</option>
        <option value="non" selected>Non</option>
    </select><br><br>

    <input type="submit" value="S'inscrire">
</form>
</body>
</html>
