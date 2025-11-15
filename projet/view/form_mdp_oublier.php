<!---------------debut: ENTETE OU BANNIERE DE LA PAGE --------------------------> 
<?php include_once ("entetePage.php"); ?>
<?php include_once ("banniereSuperieur.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->


<!----------------debut: CORPS DE LA PAGE ----------------------------------------->
<main id="body-form_connexion">

    <div class="div-form_contenu">
      <h1 class="h1-form">Veuillez saisir votre email</h1>
      <form method="POST">

          <div class="div-form_champs_labelInput">
              <label for="email">Email :</label>
              <input type="email" id="email" name="email_uti" placeholder="Saisissez votre email" required>
          </div>

          <button type="submit">Envoyer</button>
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