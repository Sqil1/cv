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
    <div id="from">
        <div class="from-box">
            <form action="" method="post" enctype="multipart/form-data">
                <ul>
                    <?php
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    ?>
                </ul>
                <div class="row-form-ajout">
                    <div class="col-form-ajout">
                        <div class="from-group">
                            <label for="poste">Poste</label>
                            <input type="text" id="poste" name="poste" class="from-control-ajout" value="<?= $poste ?>"></div>
                        <div class="from-group">
                            <label for="employeur">Employeur</label>
                            <input type="text" id="employeur" name="employeur" class="from-control-ajout"><?= $employeur ?></input>
                        </div>
                        <div class="from-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="from-control-ajout"><?= $description ?></textarea>
                        </div>
                        <div class="from-group">
                            <label for="date_debut">Date de début</label>
                            <input type="date" id="date_debut" name="date_debut" class="from-control-ajout"><?= $dateDebutExperience ?></input>
                        </div>
                        <div class="from-group">
                            <label for="date_fin">Date de fin</label>
                            <input type="date" id="date_fin" name="date_fin" class="from-control-ajout"><?= $dateFin ?></input>
                        </div>
                        <div class="from-group">
                            <button type="submit" class="button" name="submitExperience">Ajouter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>



