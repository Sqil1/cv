<?php
?>
<section id="contact">
    <div class="title">
        <h2>Me contacter</h2>
    </div>
    <?php
    /**
     * && toute la parenthèse retourne vrai si les deux sont vrai
     */
    if (isset($_GET['sendmail']) && $_GET['sendmail'] == 'success'):
        ?>
        <p class="success-sendmail">Le mail a bien été envoyé</p>
        <?php exit;
    endif ?>
    <div id="from">
        <div class="from-box">
            <form action="post_contact.php" method="POST">
                <div class="row-form-contact">
                    <div class="col-form-contact">
                        <div class="from-group">
                            <label for="inputname">Nom :</label>
                            <input type="text" name="name" class="from-control-contact" id="inputname">
                        </div>
                        <div class="from-group"">
                            <label for="inputemail">Email :</label>
                            <input type="text" name="email" class="from-control-contact" id="inputemail">
                        </div>
                        <div class="from-group">
                            <label for="inputmessage">Votre message :</label>
                              <textarea name="message" id="inputmessage" class="text-area-contact" cols="30" rows="10"></textarea>
                        </div>
                        <div class="from-group">
                        <?php if (isset($_GET['sendmail']) && $_GET['sendmail'] == 'error'): ?>
                            <p class="error-sendmail">Erreur</p>
                        <?php endif ?>
                        <button type="submit" name="send" class="btn">Envoyer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>