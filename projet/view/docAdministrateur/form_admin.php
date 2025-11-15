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



<!----------------debut: CORPS DE LA PAGE ----------------------------------------->
<main id="body-form_admin">
    <div class="div-form_contenu">

        <form method="post" enctype="multipart/form-data">
            <h1 class="h1-form_admin"> PUBLIER UN E&C </h1>
            <div class="div-form_champs_labelInput">
                <label for="nom_mat">Nom de la matiere: </label>
                <input type="text" id="nom_mat" name="nom_mat" placeholder="entrer le nom de la matiere" required>
            </div>
            <div class="div-form_champs_labelInput">
                <label for="titre_exe">Titre de l'exercice: </label>
                <input type="text" id="input-titre_exe" name="titre_exe" placeholder="entrer le titre de exercice" required>
            </div>

            <p id="p-form_admin"> INFORMATIONS RELATIVENT A L'EXERCICE </p>
                <div class="div-form_champs_labelInput">
                    <label for="libelle_exe">Ennoncé de l'exercice: </label>
                    <textarea class="textarea-form_admin" name="libelle_exe" placeholder="Ennocé de l'exercice" required></textarea>
                </div>
                
        
            <p id="p-form_admin"> INFORMATIONS RELATIVENT A LA CORRECTION </p>
                <div class="div-form_champs_labelInput">
                    <label for="id_libelle">Ennocé de la correction: </label>
                    <textarea class="textarea-form_admin" name="libelle_cor" placeholder="libelle"></textarea>
                </div>

               <div class="div-form_champs_labelInput">
                    <label for="id_fichier">PDF: </label>
                    <input type="file" id="id_fichier" name="fichier_pdf" placeholder="fichier">
               </div>
                    
            <button type="submit" name="envoyer">PUBLIER </button>

        </form>
        
    </div>
    <!--******* SCRIPT POUR ELIMINER LA BARRE DE RECHERCHE*******-->
    <script>
        var barreDeRechercheBanniere= document.getElementById('barreDeRechercheBanniere');
        if(barreDeRechercheBanniere){
            barreDeRechercheBanniere.style.display='none';
        }
    </script>
</main>
<!----------------fin: CORPS DE LA PAGE -------------------------------------------------->


<!----- Inclure le TAG de fermeture du contenu principale --------->
<?php include(DOC_ADMINISTRATEUR.'closeContenuPrincipale.php'); ?>
<!--------------------------------------------------------------->



