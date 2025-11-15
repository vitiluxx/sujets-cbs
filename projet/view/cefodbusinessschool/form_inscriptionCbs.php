<!---------------debut: ENTETE OU BANNIERE DE LA PAGE --------------------------> 
<?php require_once (VIEW_ROOT."entetePage.php"); ?>
<?php require_once (CEFODBUSINESSSCHOOL_ROOT."banniereSuperieur.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->

<!----------------debut: CORPS DE LA PAGE -------------------------->
<main id="body-form_inscription">
    <br><br>
    <div class="div-form_contenu">
        <h1 class="h1-form">Demander à être ajouté</h1>
        <form method="POST" enctype="multipart/form-data"> <!-- Ajout de enctype="multipart/form-data" pour permettre le téléchargement de fichier -->
            <div class="div-form_champs_labelInput">
                <label for="prenom_etu">Prénom :</label>
                <input type="text" id="prenom_etu" name="prenom_etu" placeholder="Votre prénom" required>
            </div>
            <div class="div-form_champs_labelInput">
                <label for="email_etu">Email :</label>
                <input type="email" id="email_etu" name="email_etu" placeholder="Votre adresse email" required>
            </div>
            <div class="div-form_champs_labelInput">
                <label for="carte_recto_etu">Recto de la carte d'étudiant :</label>
                <input type="file" id="carte_recto_etu" name="carte_recto_etu" accept="image/*" required>
                <small>Veuillez télécharger une image claire du recto de votre carte d'étudiant.</small>
            </div>
            <div class="div-form_champs_labelInput">
                <label for="carte_verso_etu">Verso de la carte d'étudiant :</label>
                <input type="file" id="carte_verso_etu" name="carte_verso_etu" accept="image/*" required>
                <small>Veuillez télécharger une image claire du verso de votre carte d'étudiant.</small>
            </div>
            <p id="textarea-remarque_sur_formulaire">
                <b>Remarque :</b> Votre demande sera traitée par un administrateur dans un délai maximum de 2 jours. Un identifiant vous sera envoyé par email dès que votre compte sera validé. Merci pour votre patience !
            </p>
            <button type="submit" name="enregistrer">Soumettre ma demande</button>
        </form>
    </div>

    <br><br><br><br><br><br><br>
</main>
<!----------------fin: CORPS DE LA PAGE -------------------------------------------------->

<!----------------DEBUT: PIED DE LA PAGE -------------------------->
<?php require("view/banniereInferieur.php"); ?>
<!----------------fin: PIED DE LA PAGE ---------------------------->