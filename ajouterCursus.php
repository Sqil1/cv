<?php
ob_start();
require_once 'database.php';

$errors = [];
$diplome = null;
$ecole = null;
$description = null;
$dateDebut = null;
$dateFin = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}
?>
<section id="ajouterExperience">
    <div class="title">
        <h2>Ajouter un Cursus</h2>
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
                            <label for="diplome">Diplome</label>
                            <input type="text" id="diplome" name="diplome" class="from-control-ajout"
                                   value="<?= $diplome ?>"></div>
                        <div class="from-group">
                            <label for="ecole">Ecole</label>
                            <input type="text" id="ecole" name="ecole" class="from-control-ajout"><?= $ecole ?></input>
                        </div>
                        <div class="from-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description"
                                      class="from-control-ajout"><?= $description ?></textarea>
                        </div>
                        <div class="from-group">
                            <label for="date_debut">Date de début</label>
                            <input type="date" id="date_debut" name="date_debut"
                                   class="from-control-ajout"><?= $dateDebut ?></input>
                        </div>
                        <div class="from-group">
                            <label for="date_fin">Date de fin</label>
                            <input type="date" id="date_fin" name="date_fin"
                                   class="from-control-ajout"><?= $dateFin ?></input>
                        </div>
                        <div class="from-group">
                            <button type="submit" class="button" name="submitCursus" class="from-control-ajout">
                                Ajouter
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>



