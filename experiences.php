<?php
require_once 'database.php';
require_once 'functions.php';
// On récupère tout le contenu de la table experience
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
                    <a href="confirm_modify.php?id=<?= $experience['id']; ?>">Modifier</a>
                    <a href="confirm_delete.php?id=<?= $experience['id']; ?>">Supprimer</a>
                    <?php endif; ?>
                </div>
            </li>

        <?php endforeach; ?>
        <li>
    </ul>
</section>