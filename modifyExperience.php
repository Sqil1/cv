<?php

require_once 'database.php';

if (isset($_GET['id'])) {
    $experienceId = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newPoste = $_POST['new_poste'];
        $newEmployeur = $_POST['new_employeur'];
        $newDescription = $_POST['new_description'];
        $newDateDebut = $_POST['new_date_debut'];
        $newDateFin = $_POST['new_date_fin'];

        $bdd = connect();
        try {
            $updateExperience = $bdd->prepare("UPDATE experience SET poste = :poste, employeur = :employeur, 
                      date_debut = :date_debut, date_fin = :date_fin, description = :description WHERE id = :id");
            $updateExperience->bindParam(':poste', $newPoste);
            $updateExperience->bindParam(':employeur', $newEmployeur);
            $updateExperience->bindParam(':description', $newDescription);
            $updateExperience->bindParam(':date_debut', $newDateDebut);
            $updateExperience->bindParam(':date_fin', $newDateFin);
            $updateExperience->bindParam(':id', $experienceId);
            $updateExperience->execute();

            header("Location: dashboard.php");
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    } else {
        $bdd = connect();
        $experienceStatement = $bdd->prepare("SELECT * FROM experience WHERE id = :id");
        $experienceStatement->bindParam(':id', $experienceId);
        $experienceStatement->execute();
        $experience = $experienceStatement->fetch();
    }
}

