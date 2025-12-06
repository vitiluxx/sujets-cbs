<!---------------debut: ENTETE OU BANNIERE DE LA PAGE --------------------------> 
<?php require_once (VIEW_ROOT."entetePage.php"); ?>
<?php require_once (CEFODBUSINESSSCHOOL_ROOT."banniereSuperieur.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->


<!----------------debut: CORPS DE LA PAGE -------------------------->
<main class="main-corpsPageSujetAccueil">
    <div class="container my-4">

        <div class="div-contenu_corpsPageListe_filieres">
            <section class="section-filiere">
                <a href="<?= HOST; ?>liste_niveaux?filiere=gi&examen=<?=$sujet;?>">
                    <p>Génie Informatique</p>
                </a>
            </section>
            <section class="section-filiere">
            <a href="<?= HOST; ?>liste_niveaux?filiere=mcd&examen=<?=$sujet;?>">
                    <p>Marketing et Communication Digitale</p>
                </a>
            </section>
            <section class="section-filiere">
            <a href="<?= HOST; ?>liste_niveaux?filiere=cf&examen=<?=$sujet;?>">
                    <p>Comptabilite Finance</p>
                </a>
            </section>
            <section class="section-filiere">
            <a href="<?= HOST; ?>liste_niveaux?filiere=lt&examen=<?=$sujet;?>">
                    <p>Logistique Transport</p>
                </a>
            </section>
            <section class="section-filiere">
            <a href="<?= HOST; ?>liste_niveaux?filiere=edd&examen=<?=$sujet;?>">
                    <p>Economie et Developpement Durable</p>
                </a>
            </section>
            <section class="section-filiere">
            <a href="<?= HOST; ?>liste_niveaux?filiere=grh&examen=<?=$sujet;?>">
                    <p>Gestion des Ressources Humaines</p>
                </a>
            </section>
            <section class="section-filiere">
            <a href="<?= HOST; ?>liste_niveaux?filiere=dcj&examen=<?=$sujet;?>">
                    <p>Droit et Carriere Judiciaire</p>
                </a>
            </section>
            <section class="section-filiere">
            <a href="<?= HOST; ?>liste_niveaux?filiere=scienceid&examen=<?=$sujet;?>">
                    <p>Science de l'Information Documentaire</p>
                </a>
            </section>
        </div>
        
    </div>
</main>
<!----------------fin: CORPS DE LA PAGE -------------------------->


<!----------------DEBUT: PIED DE LA PAGE -------------------------->
<?php   require(VIEW_ROOT."banniereInferieur.php"); ?> 
<!----------------fin: PIED DE LA PAGE ---------------------------->