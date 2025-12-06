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
    <h1 class="h1-form_admin">INSEREZ UN SUJET PDF ou IMG</h1>
    
    <form method="POST" enctype="multipart/form-data">
                
        <div class="div-form_champs_labelInput">           
            <select name="filiere" id="filiere" required>
                <option value="">Selectionner une filiere</option>
                <option value="gi">Genie informatique</option>
                <option value="mcd">Marketing et communication digitale</option>
                <option value="cf">Comptabilité finance</option>
                <option value="edd">Economie et développement durable</option>
                <option value="lt">Logistique Transport</option>
                <option value="grh">Gestion des ressources humaines</option>
                <option value="scienceid">Science de l'information documentaire</option>
                <option value="dcj">Droit et carrière judiciaire</option>
            </select><br/>
        </div>

        <div class="div-form_champs_labelInput" required>
            <label for="matiere">Nom de la matiere: </label>
            <input type="text" name="matiere" id="matiere"><br>
        </div>

        <div class="div-form_champs_labelInput" required>
            <label for="annee">Annee de composition: </label>
            <input type="texte" name="annee" id=""><br>
        </div>

        <div class="div-form_champs_labelInput" required>
            <label for="niveau">Niveau: </label>
            <select name="niveau" id="niveau">
                <option value="">Sélectionner un niveau</option>
                <option value="1">Licence 1</option>
                <option value="2">Licence 2</option>
                <option value="3">Licence 3</option>
            </select><br>
        </div>

        <div class="div-form_champs_labelInput">
            <label for="cc">Importer le PDF du CC </label>
            <input type="file" name="cc" id="cc"><br>  
        </div>

        <div class="div-form_champs_labelInput">
            <label for="sn">Importer le PDF de la SN </label>
            <input type="file" name="sn" id="sn"><br>
        </div>

        <div class="div-form_champs_labelInput">
            <label for="sr">Importer le PDF de la SR </label>
            <input type="file" name="sr" id="sr"><br>
        </div>

        <div class="div-form_champs_labelInput">
            <label for="td">Importer le PDF du TD </label>
            <input type="file" name="td" id="td"><br> 
        </div>

        <div class="div-form_champs_labelInput">
            <label for="tp">Importer le PDF du TP</label>
            <input type="file" name="tp" id="tp"><br>
        </div>


        <button type="submit" name="envoyer">Envoyer</button>

    </form>
</div>

</main>
<!----------------fin: CORPS DE LA PAGE -------------------------------------------------->


<!----- Inclure le TAG de fermeture du contenu principale --------->
<?php include(DOC_ADMINISTRATEUR.'closeContenuPrincipale.php'); ?>
<!--------------------------------------------------------------->