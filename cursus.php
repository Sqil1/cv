<?php
ob_start();
require_once './database.php';

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
                <?php if (isUserAuthenticated() && basename($_SERVER['PHP_SELF']) === 'dashboard.php'): ?>
                    <form method="post" action="modifyCursus.php?id=<?= $cursu['id']; ?>">
                        <label for="new_poste">Nouveau Poste :</label>
                        <input type="text" name="new_poste" id="new_poste" value="<?= $cursu['diplome']; ?>">
                        <label for="new_employeur">Nouvel Employeur :</label>
                        <input type="text" name="new_employeur" id="new_employeur" value="<?= $cursu['ecole']; ?>">
                        <label for="new_description">Nouvelle Description :</label>
                        <textarea name="new_description" id="new_description"><?= $cursu['description']; ?></textarea>
                        <label for="new_date_debut">Nouvelle Date de Début :</label>
                        <input type="date" name="new_date_debut" id="new_date_debut" value="<?= $cursu['date_debut']; ?>">
                        <label for="new_date_fin">Nouvelle Date de Fin :</label>
                        <input type="date" name="new_date_fin" id="new_date_fin" value="<?= $cursu['date_fin']; ?>">
                        <input type="submit" value="Modifier l'expérience">
                    </form>
                    <form method="post" action="deleteCursus.php">
                        <input type="hidden" name="id" value="<?= $cursu['id']; ?>">
                        <button type="submit" name="confirm_delete">Supprimer</button>
                    </form>
                <?php endif; ?>
            </div>
        </li>
        <?php endforeach;?>
     </ul>
</section>