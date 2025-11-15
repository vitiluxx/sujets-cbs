<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="BanniereSuperieur">

    <img src="<?php echo ASSETS_HOST; ?>images/logo05.png" alt="logoEEC" id="logo_banniereSuperieur" />
    
    <ul class="ul-global" >
        <li id="menuAccueil"><a href="<?php echo HOST; ?>accueil">Accueil</a></li>
        <li id="menuExercices"><a href="<?php echo HOST; ?>exercices">Exercices</a></li>
        <li id="menuCorrections"><a href="<?php echo HOST; ?>corrections">Corrections</a></li>
        <li id="menuSujets">
            <select id="menuDeroulant">
                <option id="option_sujet" value="selectionnez">Sujets</option>
                <option value="<?php echo HOST; ?>cefodbusinessschool">CBS</option>
                <option value="universite_ndjamena">Université de N'Djamena</option>
                <option value="emikoussi">Emikoussi</option>
                <option value="heck_tchad">Hec-Tchad</option>
            </select>
        </li>
       <script>
            document.getElementById("menuDeroulant").addEventListener("change", function() {
                var selectedOption = this.options[this.selectedIndex];
                var value = selectedOption.value;
                if (value !== "selectionnez") {
                    window.location.href = value + ".php";
                }
            });
        </script>

        <li id="menuPublierEEC"><a href="<?php echo HOST; ?>form_publierEEC">PublierE&C</a></li>
    </ul>

    <!-- <?php if ( (isset($_SESSION['auth'])) OR (isset($_SESSION['admin'])) ) : ?>
        <div id="div-bouttons-con" >
            <a href="<?=HOST;?>deconnexionUtilisateur" ><button id="boutton-con">Déconnexion</button></a>
        </div>
    <?php endif; ?> -->

    <!-- <form method="GET" id="barreDeRechercheBanniere" >
        <input type="search" name="matiere" placeholder="Rechercher par matiere" id="champ_barreDeRechercheBanniere" />
        <button type="submit">Rechercher</button>
    </form> -->

     <!-- <div id="form-bouttons-con_insc" >
        <a href="../formulaires/form_connexionUtilisateur.php"><button type= "submit" id="boutton-con">Connexion</button></a>
        <a href="../formulaires/form_inscriptionUtilisateur.php"><button type= "submit" id="boutton-insc">Inscription</button></a>
    </div>  -->

    <img src="<?php echo ASSETS_HOST.'icones/'; ?>menu.png" alt="icone menu" id="icone-menu" />
    <div class="banderole-menu">
        <!-- Contenu du menu déroulant -->
        <ul>
            <li><a id="zone_superviseur" href="<?php echo HOST; ?>zoneSuperviseur"><p>Zone Superviseur</p></a></li>
            <li id="form_admin"><a href="<?php echo HOST; ?>form_admin"><p>Formulaire admin</p></a></li>
            <li id="form_insertion"><a href="<?php echo HOST; ?>form_insertionPDF"><p>Formulaire d'insertion PDF</p></a></li>
            <li><a href="#"><p>Profil</p></a></li>
            <li><a href="#"><p>A propo</p></a></li>
            <li><a href="#"><p>Parametres</p></a></li>
        </ul>
    </div>

    <!-- <button id="menu-toggle" class="menu-toggle">&#9776;</button> -->
    <img src="<?php echo ASSETS_HOST.'icones/'; ?>menuTelephone.png" alt="icone menu" id="icone-menuTelephone" />

</header>


<?php if (isset($_SESSION['flash'])) : ?>
    <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
        <p class="alert alert-<?= $type ?>">
            <?= $message ?>
        </p>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']) ?>
<?php endif; ?>