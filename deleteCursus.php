<?php
require_once 'database.php';

if (isset($_POST['confirm_delete']) && isset($_POST['id'])) {
    $cursusId = $_POST['id'];

    $bdd = connect();

    try {
        $deleteCursus = $bdd->prepare("DELETE FROM cursus WHERE id = :id");
        $deleteCursus->bindParam(':id', $cursusId, PDO::PARAM_INT);
        $deleteCursus->execute();

        header("Location: dashboard.php?message=ok");
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la suppression du cursus : " . $e->getMessage());
    }
}