<!---------------debut: ENTETE OU BANNIERE DE LA PAGE --------------------------> 
<?php include(VIEW_ROOT."entetePage.php"); ?>
<?php include(VIEW_ROOT."banniereSuperieur.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->

<main id="body-zone">
    <div class="contenuPage">
        <span class="ligneHorizontale">
            <?php
            foreach ($table as $ligne)
            {
                if ($count % 3 == 0 && $count > 0) {
                    echo '</div><div class="ligneHorizontale">';
                }
            ?>
                <div class="tailleColonneMoyenne">
                    <section class="section-EEC_uti_zoneSuperviseur">
                        <p class="p-texte_nomMatiere"> <?= $ligne->nom_mat_uti ?> </p>
                        <p class="p-texte_exercice">Exercice : <span class="p-texte_titre"><?=$ligne->titre_exe_uti?></span> </p>
                        <span class="p-texte_dateHeurePublication"> <?= $ligne->date_pub_exe_uti ?> : <?= $ligne ->heure_pub_exe_uti ?></span>
                        <a href="<?php echo HOST; ?>form_modifierExerciceUtilisateur.php?id=<?=$ligne->id_exe_uti; ?>">Voir le contenu</a>
                    </section>
                </div>

                    <!--******* SCRIPT POUR ELIMINER LA BARRE DE RECHERCHE*******-->
                    <script>
                        var barreDeRechercheBanniere= document.getElementById('barreDeRechercheBanniere');
                        if(barreDeRechercheBanniere)
                        {
                                barreDeRechercheBanniere.style.display='none';
                        }
                    </script>

                        <?php 
                            $superviseur = "superviseur";
                            $query = "SELECT * FROM $superviseur";
                            $req = $connexionBd->query($query);
                            $req->execute();
                            $superviseurTable = $req->fetch(PDO::FETCH_OBJ);
                        
                        if($_SESSION['auth'] == $superviseurTable->pseudo_sup)
                        { ?>
                            <!--******* SCRIPT POUR CACHER L'ACCES AUX FORMULAIRE_ADMIN AINSI QUE LE FORMULAIFRE_INSERTIONPDF AU SUPERVISEUR *******-->
                            <script>
                                var elementAdmin1 = document.getElementById('form_admin');
                                var elementAdmin2 = document.getElementById('form_insertion');
                                if(elementAdmin1 ){
                                        elementAdmin1.style.display='none';
                                        elementAdmin2.style.display='none';
                                }
                            </script>

                        <?php }

                $count++;
            }
            ?>
        </span>

        <div>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        </div>
    </div>
        
</main>    

<!----------------DEBUT: PIED DE LA PAGE -------------------------->
<?php require(VIEW_ROOT."banniereInferieur.php"); ?> 
<!----------------fin: PIED DE LA PAGE ---------------------------->