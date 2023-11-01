<?php
require_once 'database.php';

if (isset($_POST['confirm_delete']) && isset($_POST['id'])) {
    $experienceId = $_POST['id'];

    $bdd = connect();

    try {
        $deleteExperience = $bdd->prepare("DELETE FROM experience WHERE id = :id");
        $deleteExperience->bindParam(':id', $experienceId, PDO::PARAM_INT);
        $deleteExperience->execute();

        echo "L'expérience a été supprimée avec succès. ";
        header("Location: dashboard.php");

    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la suppression du cursus : " . $e->getMessage());
    }
}