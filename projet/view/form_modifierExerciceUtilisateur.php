<!---------------debut: ENTETE OU BANNIERE DE LA PAGE -------------------------->
<?php include(VIEW_ROOT."entetePage.php"); ?>
<?php include(VIEW_ROOT."banniereSuperieur.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->


<!----------------debut: CORPS DE LA PAGE ----------------------------------------->
<main id="body-form_admin">
    <div class="div-form_contenu">

        <form method="POST">
            <p id="p-form_admin">MODIFIER LE CONTENU ET OU PUBLIER </p>
            <input type="hidden" name="id" value=<?= $id_exe_uti ?>>
            
            <div class="div-form_champs_labelInput">
                <label for="nom_mat">Nom de la Matiere : </label>
                <input type="text" id="nom_mat" name="nom_mat" value="<?= $nom_mat_uti ?>" placeholder="entrer le nom de la matiere">
            </div>
            <div class="div-form_champs_labelInput">
                <label for="input-titre_exe">Titre de l'exercice: </label>
                <input type="text" id="input-titre_exe" name="titre_exe" value="<?= $titre_exe_uti ?>" placeholder="entrer le titre de exercice">
            </div>
            <div class="div-form_champs_labelInput">
                <label for="textarea-libelle_exe">Ennoncé de l'exercice: </label>
                <textarea class="textarea-form_admin" id="textarea-libelle_exe" name="libelle_exe" placeholder="Ennocé de l'exercice"><?= $libelle_exe_uti ?></textarea>
            </div>
                
            <div class="div-form_champs_labelInput">
                <label for="textarea-libelle_cor">Ennoncé de la correction: </label>
                <textarea class="textarea-form_admin" id="textarea-libelle_cor" name="libelle_cor" placeholder="Ennocé de l'exercice"><?= $libelle_cor_uti ?></textarea>
            </div>

            <button type="submit" name="publier" > PUBLIER </button>
            <button type="submit" name="supprimer" > SUPPRIMER </button>
        </form>

    <div>

<!--******* SCRIPT POUR ELIMINER LE BOUTTON DECONNEXION*******-->
    <script>
        var barreDeRechercheBanniere=document.getElementById('boutton-con');
        if(barreDeRechercheBanniere)
        {
            barreDeRechercheBanniere.style.display='none';
        }
    </script>

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
<?php   require(VIEW_ROOT."banniereInferieur.php"); ?> 
<!----------------fin: PIED DE LA PAGE ---------------------------->

