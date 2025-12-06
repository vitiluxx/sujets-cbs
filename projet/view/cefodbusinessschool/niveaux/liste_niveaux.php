<!---------------debut: ENTETE OU BANNIERE DE LA PAGE --------------------------> 
<?php require_once (VIEW_ROOT."entetePage.php"); ?>
<?php require_once (CEFODBUSINESSSCHOOL_ROOT."banniereSuperieur.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->


<!----------------debut: CORPS DE LA PAGE -------------------------->
<main class="main-corpsPageSujetAccueil">
    <div class="container my-4">

        <div class="div-contenu_corpsPageSujets">

            <section class="section-sujet">
                <a href="<?= HOST.$sujet; ?>.php?filiere=<?= $_GET["filiere"]; ?>&examen=<?=$sujet;?>&niveau=1">
                    <p>Licence 1</p>
                </a>
            </section>
            <section class="section-sujet">
            <a href="<?= HOST.$sujet; ?>.php?filiere=<?= $_GET["filiere"]; ?>&examen=<?=$sujet;?>&niveau=2">
                    <p>Licence 2</p>
                </a>
            </section>
            <section class="section-sujet">
            <a href="<?= HOST.$sujet; ?>.php?filiere=<?= $_GET["filiere"]; ?>&examen=<?=$sujet;?>&niveau=3">
                    <p>Licence 3</p>
                </a>
            </section>

        </div>
        
    </div>
</br></br></br></br></br></br></br></br></br>
</main>
<!----------------fin: CORPS DE LA PAGE -------------------------->


<!----------------DEBUT: PIED DE LA PAGE -------------------------->
<?php   require(VIEW_ROOT."banniereInferieur.php"); ?> 
<!----------------fin: PIED DE LA PAGE ---------------------------->