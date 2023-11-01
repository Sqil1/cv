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
                            <div class="row-form-contact">
                                <div class="col-form-modif">
                                    <div class="from-group">
                                        <label for="new_poste">Nouveau Poste :</label>
                                        <input type="text" name="new_poste" id="new_poste" class="from-control-contact"
                                               value="<?= $cursu['diplome']; ?>">
                                    </div>
                                    <div class="from-group">
                                        <label for="new_employeur">Nouvel Employeur :</label>
                                        <input type="text" name="new_employeur" id="new_employeur"
                                               class="from-control-contact"
                                               value="<?= $cursu['ecole']; ?>">
                                    </div>
                                    <div class="from-group">
                                        <label for="new_description">Nouvelle Description :</label>
                                        <textarea name="new_description" id="new_description"
                                                  class="text-area-modif"><?= $cursu['description']; ?></textarea>
                                    </div>
                                    <div class="from-group">
                                        <label for="new_date_debut">Nouvelle Date de Début :</label>
                                        <input type="date" name="new_date_debut" id="new_date_debut"
                                               class="from-control-contact"
                                               value="<?= $cursu['date_debut']; ?>">
                                    </div>
                                    <div class="from-group">
                                        <label for="new_date_fin">Nouvelle Date de Fin :</label>
                                        <input type="date" name="new_date_fin" id="new_date_fin"
                                               value="<?= $cursu['date_fin']; ?>">
                                        <div class="col-form-modif">
                                            <button type="submit" value="Modifier le cursus">Modifier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form method="post" action="deleteCursus.php">
                            <div class="col-form-modif">
                                <input type="hidden" name="id" value="<?= $cursu['id']; ?>">
                                <button type="submit" name="confirm_delete">Supprimer</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>