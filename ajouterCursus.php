<?php

require_once 'database.php';

$errors = [];
$diplome = null;
$ecole = null;
$description = null;
$dateDebut = null;
$dateFin = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //si les champs sont vides
    if (isset($_POST['submitCursus'])) {
        $diplome = $_POST['diplome'];
        $ecole = $_POST['ecole'];
        $description = $_POST['description'];
        $dateDebut = $_POST['date_debut'];
        $dateFin = $_POST['date_fin'];

        if (!isset($diplome) || strlen($diplome) < 3) {
            $errors[] = 'Diplome pas assez long';
        }
        if (!isset($ecole) || strlen($ecole) < 3) {
            $errors[] = 'Experience assez longue';
        }
        if (!isset($description) || strlen($description) < 3) {
            $errors[] = 'Description assez longue';
        }
        if (count($errors) == 0) {
            echo 'ok';

            $bdd = connect();

            $insterCursus = $bdd->prepare("INSERT INTO cursus (diplome, ecole, description, date_debut , date_fin) values (:diplome, :ecole,
                               :description, :date_debut, :date_fin)");

            $insterCursus->bindParam(':diplome', $diplome);
            $insterCursus->bindParam(':ecole', $ecole);
            $insterCursus->bindParam(':description', $description);
            $insterCursus->bindParam(':date_debut', $dateDebut);
            $insterCursus->bindParam(':date_fin', $dateFin);

            $insterCursus->execute();

            die();
        }
    }
}
?>
<section id="ajouterExperience">
    <div class="title">
        <h2>Ajouter un Cursus</h2>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <?php
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            ?>
        </ul>
        <div class="">
            <label for="diplome">Diplome</label>
            <input type="text" id="diplome" name="diplome" value="<?= $diplome ?>"></div>
        <div class="">
            <label for="ecole">Ecole</label>
            <input type="text" id="ecole" name="ecole"><?= $ecole ?></input>
        </div>
        <div class="">
            <label for="description">Description</label>
            <textarea id="description" name="description"><?= $description ?></textarea>
        </div>
        <div class="">
            <label for="date_debut">Date de début</label>
            <input type="date" id="date_debut" name="date_debut"><?= $dateDebut ?></input>
        </div>
        <div class="">
            <label for="date_fin">Date de fin</label>
            <input type="date" id="date_fin" name="date_fin"><?= $dateFin ?></input>
        </div>
        <div class="inset">
            <button type="submit" class="button" name="submitCursus">Ajouter</button>
        </div>

    </form>
</section>



