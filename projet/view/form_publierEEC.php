<!---------------debut: ENTETE OU BANNIERE DE LA PAGE --------------------------> 
<?php require_once (DOC_ADMINISTRATEUR."head.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->

<!-------------- Inclure la Sidebar -------------->
<?php include(DOC_ADMINISTRATEUR.'sidebar.php'); ?>
<!--------------------------------------------------------->

<!-------------------------------------------------------------> 
<!-- Inclure le TAG d'ouverture du contenu principale -->
<?php include(DOC_ADMINISTRATEUR.'openContenuPrincipale.php'); ?>
<!--------------------------------------------------------------->

    
<!----------------debut: CORPS DE LA PAGE -------------------------->
<main id="body-form_publierEEC">
<div class="div-form_contenu">

    <form method="post">
        <p id="p-form_admin"> SOUMETTRE UN E&C </p>
        <div>
            <label for="nom_mat">Nom de la matiere: </label>
            <input type="text" id="nom_mat" name="nom_mat" placeholder="entrer le nom de la matiere">
        </div>
        <div>
            <label for="titre_exe">Titre de l'exercice: </label>
            <input type="text" id="input-titre_exe" name="titre_exe" placeholder="entrer le titre de exercice">
        </div>

        <h3 class="h1-form_admin"> INFORMATIONS RELATIVES A L'EXERCICE </h3>
            <div>
                <label for="libelle_exe">Ennoncé de l'exercice: </label>
                <textarea class="textarea-form_admin" name="libelle_exe" placeholder="Ennocé de l'exercice"></textarea>
            </div>
            
        <h3 class="h1-form_admin"> INFORMATIONS RELATIVES A LA CORRECTION </h3>
            <div>
                <label for="id_libelle">Ennocé de la correction: </label>
                <textarea class="textarea-form_admin" name="libelle_cor" placeholder="libelle"></textarea>
            </div>

        <button type="submit" name="soumettre"> SOUMETTRE </button>

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
<!----------------fin: CORPS DE LA PAGE ---------------------------->



<!----- Inclure le TAG de fermeture du contenu principale --------->
<?php include(DOC_ADMINISTRATEUR.'closeContenuPrincipale.php'); ?>
<!--------------------------------------------------------------->