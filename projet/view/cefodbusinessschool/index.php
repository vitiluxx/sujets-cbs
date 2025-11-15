<!---------------debut: ENTETE OU BANNIERE DE LA PAGE --------------------------> 
<?php require_once (VIEW_ROOT."entetePage.php"); ?>
<?php require_once (CEFODBUSINESSSCHOOL_ROOT."banniereSuperieur.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->


<!----------------debut: CORPS DE LA PAGE -------------------------->
<br/><br/>
<main class="main-corpsPageSujetAccueil">

    <div class="div-contenu_corpsPageSujets">
        <section class="section-sujet">
            <a href="<?= HOST; ?>liste_filieres.php?sujet=cc">
                <p>CONTROLES CONTINUS</p>
            </a>
        </section>
        <section class="section-sujet">
            <a href="<?= HOST; ?>liste_filieres.php?sujet=sn">
                <p>SESSIONS NORMALES</p>
            </a>
        </section>
        <section class="section-sujet">
            <a href="<?= HOST; ?>liste_filieres.php?sujet=sr">
                <p>SESSIONS RATTRAPAGES</p>
            </a>
        </section>
        <section class="section-sujet">
            <a href="<?= HOST; ?>liste_filieres.php?sujet=bts">
                <p>BREVET DE TECHNICIEN SUPERIEUR</p>
            </a>
        </section>
        <section class="section-sujet">
            <a href="<?= HOST; ?>liste_filieres.php?sujet=td">
                <p>TRAVAUX DIRIGES</p>
            </a>
        </section>
        <section class="section-sujet">
            <a href="<?= HOST; ?>liste_filieres.php?sujet=tp">
                <p>TRAVAUX PRATIQUES</p>
            </a>
        </section>
    </div>

    
    <div>
        <br><br><br><br><br>
    </div>

</main>
<!----------------fin: CORPS DE LA PAGE -------------------------->


<!----------------DEBUT: PIED DE LA PAGE -------------------------->
<?php   require(VIEW_ROOT."banniereInferieur.php"); ?> 
<!----------------fin: PIED DE LA PAGE ---------------------------->