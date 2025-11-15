<!---------------debut: ENTETE OU BANNIERE DE LA PAGE --------------------------> 
<?php include_once ("entetePage.php"); ?>
<?php include_once ("banniereSuperieur.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->


<!----------------debut: CORPS DE LA PAGE ----------------------------------------->
<main id="body-form_connexion">
<br><br>
    <div class="div-form_contenu">
      <h1 class="h1-form">Se connecter à son compte E&C</h1>
      <form method="POST">

          <div class="div-form_champs_labelInput">
              <label for="email_uti">Email :</label>
              <input type="email" id="email" name="email_uti" placeholder="Saisissez votre email" required>
          </div>
          <div class="div-form_champs_labelInput">
              <label for="mdp_uti">Mot de passe :</label>
              <input type="password" id="motdepasse" name="mdp_uti" placeholder="Saisissez votre mot de passe" required>
          </div>
          
            <?php if (isset($error) && $error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

          <div class="form-group">
            <label for="password"> <input type="checkbox" name="remember" value="1"> Se souvenir de moi</label>
            <a href="<?php echo HOST; ?>form_mdp_oublier.php" style=" color: red ">J'ai oublié mon mot de passe</a>
          </div>


          <button type="submit" name="boutonconnexion">Connexion</button> 
          <a href="form_inscriptionUtilisateur.php"><button type="button">Creer un compte</button></a>

      </form>
    </div> 

    
<br><br><br><br><br><br><br><br><br>
</main>
<!----------------fin: CORPS DE LA PAGE -------------------------->


<!----------------DEBUT: PIED DE LA PAGE -------------------------->
<?php include_once("banniereInferieur.php"); ?> 
<!----------------fin: PIED DE LA PAGE ---------------------------->




