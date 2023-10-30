<?php

require_once './database.php';
// On récupère tout le contenu de la table experience
$bdd = connect();

try {
    $cursusStatement = $bdd->prepare("SELECT * FROM cursus ORDER BY date_debut DESC");
    $cursusStatement->execute();
    $cursus = $cursusStatement->fetchall();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<section id="cursus">
    <div class="title">
        <h2>Cursus</h2>
    </div>
    <ul class=container-cursus>
        <?php foreach ($cursus as $cursu): ?>
        <li>
            <div class="cursus">
                <h3><?= $cursu['diplome']; ?></h3>
                <div class="align-item-center">
                    <span class="icon-pen"></span>
                    <?= $cursu['ecole']; ?>
                </div>
                <div>
                    <span class="icon-calendar"></span><?= $cursu['date_debut']; ?> - <?= $cursu['date_fin']; ?>
                </div>
            </div>
        </li>
        <?php endforeach;?>
     </ul>
</section>