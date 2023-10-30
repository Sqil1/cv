<?php
require_once 'database.php';

if (isset($_POST['confirm_delete']) && isset($_POST['id'])) {
    $cursusId = $_POST['id'];

    $bdd = connect();

    try {
        $deleteCursus = $bdd->prepare("DELETE FROM cursus WHERE id = :id");
        $deleteCursus->bindParam(':id', $cursusId, PDO::PARAM_INT);
        $deleteCursus->execute();

        echo "Le cursus a été supprimée avec succès. ";
        header("Location: dashboard.php");
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression du cursus : " . $e->getMessage();
    }
}