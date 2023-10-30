<?php

require_once 'database.php';

if (isset($_GET['id'])) {
    $cursusId = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newDiplome = $_POST['new_poste'];
        $newEcole = $_POST['new_employeur'];
        $newDescription = $_POST['new_description'];
        $newDateDebut = $_POST['new_date_debut'];
        $newDateFin = $_POST['new_date_fin'];

        $bdd = connect();
        try {
            $updateCursus = $bdd->prepare("UPDATE cursus SET diplome = :diplome, ecole = :ecole, 
                  date_debut = :date_debut, date_fin = :date_fin, description = :description WHERE id = :id");
            $updateCursus->bindParam(':diplome', $newDiplome);
            $updateCursus->bindParam(':ecole', $newEcole);
            $updateCursus->bindParam(':description', $newDescription);
            $updateCursus->bindParam(':date_debut', $newDateDebut);
            $updateCursus->bindParam(':date_fin', $newDateFin);
            $updateCursus->bindParam(':id', $cursusId);
            $updateCursus->execute();

            header("Location: dashboard.php");
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    } else {
        $bdd = connect();
        $cursusStatement = $bdd->prepare("SELECT * FROM cursus WHERE id = :id");
        $cursusStatement->bindParam(':id', $cursusId);
        $cursusStatement->execute();
        $cursus = $cursusStatement->fetch();
    }
}

