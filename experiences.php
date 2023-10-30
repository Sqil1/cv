<?php
ob_start();
require_once 'database.php';
require_once 'functions.php';

$bdd = connect();

try {
    $experienceStatement = $bdd->prepare("SELECT * FROM experience ORDER BY date_debut DESC");
    $experienceStatement->execute();
    $experiences = $experienceStatement->fetchall();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// TO DO : regrouper la requetes sql dans une classe

?>

<section id="experience">
    <div class="title">
        <h2>Expériences</h2>
    </div>

    <ul class=container-experience>
        <!--        boucle pour récuperer les données dans la table expérience-->
        <?php foreach ($experiences as $experience): ?>
            <?php
            // TO DO faire une fonction format date
            $format_date_debut = new DateTime($experience['date_debut']);
            $date_debut = $format_date_debut->format('m-Y');
            ?>
            <?php
            $format_date_fin = new DateTime($experience['date_fin']);
            $date_fin = $format_date_fin->format('m-Y');
            ?>
            <li>
                <div class="experience">
                    <h3><?= $experience['poste']; ?></h3>
                    <div class="align-item-center">
                        <span class="icon-office"></span>
                        <?= $experience['employeur']; ?>
                    </div>
                    <div>
                        <span class="icon-calendar"></span><?= $date_debut; ?>
                        - <?= ($experience['date_fin'] == '0000-00-00') ? "AUJOURD'HUI" : $date_fin; ?>
                    </div>
                    <?php if (isUserAuthenticated() && basename($_SERVER['PHP_SELF']) === 'dashboard.php'): ?>
                        <form method="post" action="modifyExperience.php?id=<?= $experience['id']; ?>">
                            <label for="new_poste">Nouveau Poste :</label>
                            <input type="text" name="new_poste" id="new_poste" value="<?= $experience['poste']; ?>">
                            <label for="new_employeur">Nouvel Employeur :</label>
                            <input type="text" name="new_employeur" id="new_employeur" value="<?= $experience['employeur']; ?>">
                            <label for="new_description">Nouvelle Description :</label>
                            <textarea name="new_description" id="new_description"><?= $experience['description']; ?></textarea>
                            <label for="new_date_debut">Nouvelle Date de Début :</label>
                            <input type="date" name="new_date_debut" id="new_date_debut" value="<?= $experience['date_debut']; ?>">
                            <label for="new_date_fin">Nouvelle Date de Fin :</label>
                            <input type="date" name="new_date_fin" id="new_date_fin" value="<?= $experience['date_fin']; ?>">
                            <input type="submit" value="Modifier l'expérience">
                        </form>
                        <form method="post" action="deleteExperience.php">
                            <input type="hidden" name="id" value="<?= $experience['id']; ?>">
                            <button type="submit" name="confirm_delete">Supprimer</button>
                        </form>
                    <?php endif; ?>
                </div>
            </li>

        <?php endforeach; ?>
        <li>
    </ul>
</section>

