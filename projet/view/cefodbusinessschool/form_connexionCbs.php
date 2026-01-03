<!---------------debut: ENTETE OU BANNIERE DE LA PAGE --------------------------> 
<?php require_once (VIEW_ROOT."entetePage.php"); ?>
<?php require_once (CEFODBUSINESSSCHOOL_ROOT."banniereSuperieur.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->

<!----------------debut: CORPS DE LA PAGE -------------------------->
<main id="body-form_connexion">

        <!-- ✅ Affichage du message -->
        <?php if (!empty($message_inscription)): ?>
            <div style="
                background-color:rgba(5, 120, 10, 0.69);
                color:rgb(255, 255, 255);
                border: 1px solid #c8e6c9;
                padding: 12px;
                border-radius: 8px;
                margin: 15px auto;
                font-size: 15px;
                text-align: center;
                width: 90%;
                max-width: 500px;
                box-sizing: border-box;
            ">
            <br/><br/>
                <?= $message_inscription; ?>
            </div>
        <?php endif; ?>

    <br>
    <div class="div-form_contenu">
        <h1 class="h1-form">Se connecter</h1>
        <form method="POST">
        <p id="textarea-remarque_sur_formulaire">
            <b style="color:red;">Remarque :</b> Vous ne pouvez vous connecter que si vous avez préalablement reçu votre identifiant par e-mail.
        </p>
            <div class="div-form_champs_labelInput">
                <label for="identifiant_etu">Identifiant de connexion :</label>
                <input type="text" id="identifiant_etu" name="identifiant_etu" placeholder="Votre identifiant" required>
            </div>

            <button type="submit" name="connexion">Connexion</button>
            <div class="form-inscription">
                <p>Pas encore d'identifiant ? <a href="<?= HOST;?>form_inscriptionCbs">Demandez-en un ici</a></p>
            </div>
        </form>
    </div>

    <br><br><br><br><br><br><br>
</main>
<!----------------fin: CORPS DE LA PAGE -------------------------------------------------->

<!----------------DEBUT: PIED DE LA PAGE -------------------------->
<?php require("view/banniereInferieur.php"); ?>
<!----------------fin: PIED DE LA PAGE ---------------------------->
