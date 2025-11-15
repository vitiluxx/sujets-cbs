<!---------------debut: ENTETE OU BANNIERE DE LA PAGE --------------------------> 
<?php include_once ("entetePage.php"); ?>
<?php include_once ("banniereSuperieur.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->


<!----------------debut: CORPS DE LA PAGE ----------------------------------------->
<main id="body-form_connexion">
    <div class="div-form_contenu">
      <h1 class="h1-form">Reinitialisation du mot de passe</h1>
      <form method="POST">

          <div class="div-form_champs_labelInput">
          <label for="password">Mot de passe</label>
          <input type="password" name="password" id="password" class="form-control">
          </div>
          
          
          <div class="div-form_champs_labelInput">
          <label for="password">Confirmation du mot de passe</label>
          <input type="password" name="password_confirm" id="password" class="form-control">
          </div>


          <button type="submit">Valider</button>

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

<!----------------fin: CORPS DE LA PAGE -------------------------->

<!----------------DEBUT: PIED DE LA PAGE -------------------------->
<?php include_once("banniereInferieur.php"); ?>
<!----------------fin: PIED DE LA PAGE ---------------------------->