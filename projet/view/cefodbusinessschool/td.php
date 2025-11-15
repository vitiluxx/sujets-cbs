<!---------------debut: ENTETE OU BANNIERE DE LA PAGE --------------------------> 
<?php require_once (VIEW_ROOT."entetePage.php"); ?>
<?php require_once (CEFODBUSINESSSCHOOL_ROOT."banniereSuperieur.php"); ?>
<!----------------fin: ENTETE DE LA PAGE ----------------------------------------->

<!----------------debut: CORPS DE LA PAGE -------------------------->
<br/>
<main class="main-corpsPageSujetsCcSnSrTdTp">
 
    <?php
    if( isset($_GET["filiere"]) && !empty($_GET["filiere"]) )
    {
        $filiere = (string) $_GET["filiere"];
        $liste_filieres = [
            'Genie Informatique' => 'gi',
            'Marketing et Communication Digitale' => 'mcd',
            'Comptabilite Finance' => 'cf',
            'Logistique Transport' => 'lt',
            'Economie et Developpement Durable' => 'edd',
            'Gestion des Ressources Humaines' => 'grh',
            'Droit et Carriere Judiciaire' => 'dcj',
            'Science de l\'Information Documentaire' => 'scienceid'
        ];

        // Filtrage des valeurs vides ou non valides pour éviter les erreurs
        $filiere_key = array_search($filiere, $liste_filieres); // Récupère la clé de la filière
        if ($filiere_key !== false)
        {
            $examen = (string) $_GET["examen"];
            $table = $eec->afficherSujetExamen($examen,$filiere);
                
                if (!empty($table)):
                ?>
                <?php foreach($liste_filieres as $key => $valeur) : 
                    if($valeur === $filiere)
                    {
                        echo '<h1 style="font-weight: bold;">'.$key.'</h1>';
                    }      
                endforeach; ?>
                <section class="section-sujets">
                    <p>TRAVEAUX DIRIGES</p>
                        <table id="laTable" class="display"> <!-- la classe 'display' de cette balise <table> permet à DataTables de reconnaître que cette table doit être mise en forme. -->
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                          <?php foreach ($table as $ligne):
                                    if(isset($ligne->id) AND !empty($ligne->id)):
                                        $id = $ligne->id; // L'ID du fichier à télécharger ?>
                                        <tr>
                                            <td>
                                                <a href="fonctions/telechargerPdfCc.php?id=<?= $id ?>&filiere=<?= $filiere ?>">
                                                    <img src="<?php echo ASSETS_HOST; ?>icones/pdf1.png" alt="Icône PDF" class="pdf-icon"> <!-- icon PDF .png -->
                                                </a>
                                            </td>
                                            <td><?= $ligne->matiere ?></td> <!-- Nom de la matière -->
                                            <td><?= $ligne->annee ?></td> <!-- Année -->
                                            <td>
                                                <a href="<?php HOST;?>telechargerPdfCc.php?id=<?= $id ?>&filiere=<?= $filiere ?>">
                                                    <button id="telecharger">Télécharger</button>
                                                </a> <!-- Bouton Télécharger -->
                                            </td>
                                        </tr>
                              <?php endif;
                                endforeach; ?>
                            </tbody>
                        </table>

                </section>
                <?php
                endif;

                ?>

                <div>
                    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                </div>
                <!--******* SCRIPT POUR ELIMINER LE BOUTTON DECONNEXION*******-->
                <script>
                
                    var barreDeRechercheBanniere= document.getElementById('boutton-con');
                    if(barreDeRechercheBanniere){
                            barreDeRechercheBanniere.style.display='none';
                    }
                </script>
  <?php }
            $filiere_exist = in_array($filiere, $liste_filieres); // Vérifie si la filière existe dans la liste des filières
            if (!$filiere_exist) {
                include_once (VIEW_ROOT.'erreur404.php');   
            }

    }?>
</main>

 
<!----------------fin: CORPS DE LA PAGE -------------------------->


<!----------------DEBUT: PIED DE LA PAGE -------------------------->
<?php   require(VIEW_ROOT."banniereInferieur.php"); ?> 
<!----------------fin: PIED DE LA PAGE ---------------------------->

<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.0/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#laTable').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json" // Traduction en français
            },
            paging: true,
            autoWidth: false,
            responsive: false,
            info: false,
            ordering: false,

        });
    });
</script>
