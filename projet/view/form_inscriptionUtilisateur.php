<!---------------debut: ENTETE OU BANNIERE DE LA PAGE --------------------------> 
<?php require_once ("entetePage.php"); ?>
<?php require_once ("banniereSuperieur.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->


<!----------------debut: CORPS DE LA PAGE -------------------------->
<main id="body-form_inscription">
    <div class="div-form_contenu">
        <h1 class="h1-form">Crée son compte E&C</h1>
        <form method="POST">

            <div class="div-form_champs_labelInput">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom_uti" placeholder="Saisissez votre nom" required>
            </div>
            <div class="div-form_champs_labelInput">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom_uti" placeholder="Saisissez votre prénom" required>
            </div>
            <div class="div-form_champs_labelInput">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email_uti" placeholder="Saisissez votre email" required>
            </div>
            <div class="div-form_champs_labelInput">
                <label for="motdepasse">Mot de passe :</label>
                <input type="password" id="motdepasse" name="mdp_uti" placeholder="Saisissez votre mot de passe" required>
            </div>
            <div class="div-form_champs_labelInput">
                <label for="motdepasse">Confirmer votre Mot de passe :</label>
                <input type="password" id="motdepasse" name="confirmation_mdp_uti" placeholder="Saisissez votre mot de passe" required>
            </div>
           <button type="submit" name="enregistrer">Création</button>

        </form>
    </div>
     <!--******* SCRIPT POUR ELIMINER LA BARRE DE RECHERCHE*******-->
     <script>
        var barreDeRechercheBanniere= document.getElementById('barreDeRechercheBanniere');
        if(barreDeRechercheBanniere)
        {
            barreDeRechercheBanniere.style.display='none';
        }
    </script>
</main>
<!----------------fin: CORPS DE LA PAGE -------------------------------------------------->


<!----------------DEBUT: PIED DE LA PAGE -------------------------->
<?php   require("banniereInferieur.php"); ?> 
<!----------------fin: PIED DE LA PAGE ---------------------------->
