<?php
ob_start();
require_once 'database.php';

$errors = [];
$poste = null;
$employeur = null;
$description = null;
$dateDebutExperience = null;
$dateFin = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submitExperience'])) {
        $poste = $_POST['poste'];
        $employeur = $_POST['employeur'];
        $description = $_POST['description'];
        $dateDebutExperience = $_POST['date_debut'];
        $dateFin = $_POST['date_fin'];

        if (!isset($poste) || strlen($poste) < 3) {
            $errors[] = 'Poste pas assez long';
        }
        if (!isset($employeur) || strlen($employeur) < 3) {
            $errors[] = 'Experience assez longue';
        }
        if (!isset($description) || strlen($description) < 3) {
            $errors[] = 'Description assez longue';
        }
        if (count($errors) == 0) {
            echo 'ok';

            $bdd = connect();

            $insterExperience = $bdd->prepare("INSERT INTO experience (poste, employeur, description, date_debut , date_fin) values (:poste, :employeur,
                               :description, :date_debut, :date_fin)");

            $insterExperience->bindParam(':poste', $poste);
            $insterExperience->bindParam(':employeur', $employeur);
            $insterExperience->bindParam(':description', $description);
            $insterExperience->bindParam(':date_debut', $dateDebutExperience);
            $insterExperience->bindParam(':date_fin', $dateFin);

            $insterExperience->execute();

            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}
?>
<section id="ajouterExperience">
    <div class="title">
        <h2>Ajouter une expérience</h2>
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
            <label for="poste">Poste</label>
            <input type="text" id="poste" name="poste" value="<?= $poste ?>"></div>
        <div class="">
            <label for="employeur">Employeur</label>
            <input type="text" id="employeur" name="employeur"><?= $employeur ?></input>
        </div>
        <div class="">
            <label for="description">Description</label>
            <textarea id="description" name="description"><?= $description ?></textarea>
        </div>
        <div class="">
            <label for="date_debut">Date de début</label>
            <input type="date" id="date_debut" name="date_debut"><?= $dateDebutExperience ?></input>
        </div>
        <div class="">
            <label for="date_fin">Date de fin</label>
            <input type="date" id="date_fin" name="date_fin"><?= $dateFin ?></input>
        </div>
        <div class="inset">
            <button type="submit" class="button" name="submitExperience">Ajouter</button>
        </div>

    </form>
</section>



