<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
/**
 * CLASS Controller
 *      permettant de remplacer ce code ecris de maniere procedural 
 *      maintenant d'une maniere oriente objet pour acceder au page de la vue 
 *      juste en appelant des methodes 
 * 
 * En faite en gros cette CLASS prend tout le contenus (partie traitement en php) 
 * de nos differents pages et les met dans des methodes au lieu d'utiliser des fichiers.php
 * et appel en suite la vue de chaque page depuis le dossier "view"  
 */
class ControllerAdmin
{
    /*============================================================================================================================ */  
    public function affichePagedemandesInscription()
    {
        // Connexion à la base de données
        require("connexionBd.php");
        require(MODEL_ROOT."ExercicesEtCorrections.class.php");
        $eec = new ExercicesEtCorrections($connexionBd);
        require(MODEL_ROOT."fonctions.php");
        
        // Empêcher la mise en cache
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        securiteAdmin();

        // Traitement de la confirmation d'inscription
        if (isset($_POST['boutton_confirmer'])) {
            $idEtu = $_POST['id_etu'];
            $prenomEtu = strtolower(htmlspecialchars($_POST['prenom_etu']));
            $emailEtu = strtolower($_POST['email_etu']);
        
            if ($idEtu && $prenomEtu && $emailEtu) {
                $identifiant = $eec->filtrerDonnees($prenomEtu).$eec->filtrerDonnees($idEtu);
            
                try {
                    // Début de la transaction
                    /* beginTransaction(), Démarre une nouvelle transaction.

                    Une transaction permet de regrouper plusieurs requêtes SQL en une seule unité de travail.
                    
                    Tant que la transaction n'est pas validée (commit()), les modifications ne sont pas appliquées à la base de données. */
                    $connexionBd->beginTransaction(); 
                
                    // 1. Insérer l'étudiant dans la table principale (etudiant_cbs)
                    $query = "INSERT INTO etudiant_cbs (prenom_etu, email_etu, identifiant_etu, compte_confirme_etu)
                              SELECT prenom_etu, email_etu, :identifiant, 1 FROM etudiant_cbs_temp WHERE id_etu = :id_etu";
                    $stmt = $connexionBd->prepare($query);
                    $stmt->execute([":identifiant" => $identifiant, ":id_etu" => $idEtu]);
                
                    // 2. Supprimer la demande de la table temporaire (etudiant_cbs_temp)
                    $query = "DELETE FROM etudiant_cbs_temp WHERE id_etu = :id_etu";
                    $stmt = $connexionBd->prepare($query);
                    $stmt->execute([":id_etu" => $idEtu]);
                
                    // 3. Envoyer un email de confirmation
                    // require ROOT . 'vendor/autoload.php'; // Inclure PHPMailer
                
                    // $mail = new PHPMailer(true);
                    // try {
                    //     // Configuration SMTP
                    //     $mail->isSMTP();
                    //     $mail->Host = 'smtp.gmail.com';
                    //     $mail->SMTPAuth = true;
                    //     $mail->Username = SMTP_USERNAME;
                    //     $mail->Password = SMTP_PASSWORD;
                    //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    //     $mail->Port = 587;
                    
                    //     // Destinataire et contenu
                    //     $mail->setFrom('gdc6.td@gmail.com', 'Sujets CBS - Plateforme Web');
                    //     $mail->addAddress($emailEtu);
                    //     $mail->isHTML(true);
                    //     $mail->Subject = 'Confirmation de votre inscription';
                    //     $mail->Body = "
                    //         <h1>Félicitations, votre inscription a été confirmée !</h1>
                    //         <p>Votre identifiant de connexion est : <strong>$identifiant</strong></p>
                    //         <p>Utilisez cet identifiant pour vous connecter à votre compte.</p>
                    //     ";
                    
                    //     $mail->send();
                    // } catch (Exception $e) {
                    //     // Annuler la transaction en cas d'erreur d'envoi d'email
                    //     $connexionBd->rollBack();
                    //     $_SESSION['flash']['error'] = "Erreur lors de l'envoi de l'email : " . $mail->ErrorInfo;
                    //     header("Location: " . HOST . "demandesInscription");
                    //     exit();
                    // }
                
                    // Valider la transaction
                    /* commit(), Valide la transaction en cours.
                        Toutes les modifications effectuées depuis le début de la transaction sont appliquées à la base de données. */
                    $connexionBd->commit();
                    ?>
                    <script>
                        alert("Inscription confirmée et email envoyé avec succès !");
                    </script>
                    <?php

                    header("Location: " . HOST . "demandesinscription");
                    exit();
                } catch (PDOException $e) {
                    // Annuler la transaction en cas d'erreur
                    /* Annule la transaction en cours.
                        Toutes les modifications effectuées depuis le début de la transaction sont annulées. */
                    $connexionBd->rollBack();
                    ?>
                    <script>
                        alert("Erreur de base de données : ". $e->getMessage());
                    </script>
                    <?php

                    header("Location: " . HOST . "demandesinscription");
                    exit();
                }
            } else {
                ?>
                <script>
                    alert("Données invalides.");
                </script>
                <?php
                header("Location: " . HOST . "demandesinscription");
                exit();
            }
        }

        // Traitement de la suppression de la demande
        if (isset($_POST['boutton_supprimer'])) {
            $idEtu = filter_var($_POST['id_etu'], FILTER_VALIDATE_INT);
        
            if ($idEtu) {
                try {
                    // Supprimer la demande de la table temporaire (etudiant_cbs_temp)
                    $query = "DELETE FROM etudiant_cbs_temp WHERE id_etu = :id_etu";
                    $stmt = $connexionBd->prepare($query);
                    $stmt->execute([":id_etu" => $idEtu]);
                    ?>
                    <script>
                        alert("Demande supprimée avec succès");
                    </script>
                    <?php
                    header("Location: " . HOST . "demandesinscription");
                    exit();
                } catch (PDOException $e)
                {
                    ?>
                    <script>
                        alert("Erreur de base de données : " . $e->getMessage(););
                    </script>
                    <?php
                    header("Location: " . HOST . "demandesinscription");
                    exit();
                }
            } else {
                ?>
                    <script>
                        alert("Données invalides.");
                    </script>
                <?php
                header("Location: " . HOST . "demandesinscription");
                exit();
            }
        }

        include(DOC_ADMINISTRATEUR . "demandesInscription.php");
    
    }
    /*============================================================================================================================ */  
        
   

    /*============================================================================================================================ */  
   
    public function affichePageListeEtudiantsInscrits()
    {
        require("connexionBd.php");
        require(MODEL_ROOT."ExercicesEtCorrections.class.php");
        $eec = new ExercicesEtCorrections($connexionBd);
        require(MODEL_ROOT."fonctions.php");
        securiteAdmin();
      
        include(DOC_ADMINISTRATEUR . "listeetudiantsinscrits.php");
    
    }
    /*============================================================================================================================ */  
    
    public function affichePageZoneAdmin() 
    {                        
        require("connexionBd.php");
        require(MODEL_ROOT."ExercicesEtCorrections.class.php");
        require(MODEL_ROOT."fonctions.php");
        securiteAdmin();

        $eec = new ExercicesEtCorrections($connexionBd);
            
        $etudiants = $eec->afficherEtudiantsCbsTemP();

       
        if(isset($_POST['boutton_ajouter']))
        {
            $id_etu = (int)$_POST['id_etu'];
            // var_dump($id_etu);die();
            $etudiant = $eec->afficherUnEtudiantCbs($id_etu);

            $prenom_etu = $etudiant->prenom_etu; 
            $email_etu = $etudiant->email_etu; 
            $carte_etu = $etudiant->carte_etu; 
            $identifiant_etu = $prenom_etu . $id_etu;

            $resultat = $eec->insererEtudiantCbs($prenom_etu, $email_etu, $carte_etu, $identifiant_etu);
                if($resultat == true)
                {
                   $eec->supprimerEtudiantCbsTemp($id_etu);
                    ?>
                        <script>
                            alert("Etudiant ajouté avec succes");
                        </script>
                    <?php
                        header("Refresh: 1; url=" . HOST . "zoneAdmin.php");  
                        exit();

                }
        }

        if(isset($_POST['boutton_supprimer']))
        {
            $id_etu = (int)$_POST['id_etu'];
            // var_dump($id_etu);die();

              $eec->supprimerEtudiantCbsTemp($id_etu);
                ?>
                    <script>
                        alert("Etudiant supprimer avec succes");
                    </script>
                <?php
                    header("Refresh: 0; url=" . HOST . "zoneAdmin.php");  
                    exit();
        }
      
        include(DOC_ADMINISTRATEUR."zoneAdmin.php");
    }

/*============================================================================================================================ */

    public function affichePageSujetsPdf()
    {
        require("connexionBd.php");
        require(MODEL_ROOT."ExercicesEtCorrections.class.php");
        require(MODEL_ROOT."fonctions.php");
        securiteAdmin();

        $eec = new ExercicesEtCorrections($connexionBd);
        $filieres = [
            "gi" => "Génie Informatique",
            "mcd" => "Marketing et Communication Digitale",
            "cf" => "Comptabilité et Finance",
            "lt" => "Logistique Transport",
            "edd" => "Economie et Développement Durable",
            "grh" => "Gestion des Ressources Humaines",
            "dcj" => "Droit et Carrière Judiciaire",
            "scienceid" => "Sciences de l'Information et de la Documentation"
        ];
        $examens = ['cc', 'sn', 'sr', 'bts', 'td', 'tp'];

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action'])) {
            $action = $_POST['action'];
            $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
            $filiere = $_POST['filiere'] ?? '';

            if (!$id || !array_key_exists($filiere, $filieres)) {
                ?>
                <script>
                    alert("Données invalides.");
                </script>
                <?php
                header("Refresh: 0; url=" . HOST . "sujetspdf");
                exit();
            }

            if ($action === 'supprimer') {
                $sujet = $eec->recupererSujetParId($filiere, $id);
                if ($sujet) {
                    foreach ($examens as $colonne) {
                        if (!empty($sujet->$colonne)) {
                            $chemin = ASSETS_ROOT . "uploads/docpdf/" . $sujet->$colonne;
                            if (is_file($chemin)) {
                                @unlink($chemin);
                            }
                        }
                    }
                    $eec->supprimerSujetComplet($filiere, $id);
                    ?>
                    <script>
                        alert("Sujet PDF supprimé avec succès.");
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        alert("Sujet introuvable.");
                    </script>
                    <?php
                }
                header("Refresh: 0; url=" . HOST . "sujetspdf");
                exit();
            }

            if ($action === 'modifier') {
                $matiere = trim($_POST['matiere'] ?? '');
                $annee = trim($_POST['annee'] ?? '');
                $niveau = isset($_POST['niveau']) && !empty($_POST['niveau']) ? (int)$_POST['niveau'] : null;

                if ($matiere === '') {
                    ?>
                    <script>
                        alert("Le champ matière est obligatoire.");
                    </script>
                    <?php
                    header("Refresh: 0; url=" . HOST . "sujetspdf");
                    exit();
                }

                // Validation du niveau
                if ($niveau !== null && ($niveau < 1 || $niveau > 3)) {
                    ?>
                    <script>
                        alert("Le niveau doit être entre 1 et 3.");
                    </script>
                    <?php
                    header("Refresh: 0; url=" . HOST . "sujetspdf");
                    exit();
                }

                $sujetExistant = $eec->recupererSujetParId($filiere, $id);
                if (!$sujetExistant) {
                    ?>
                    <script>
                        alert("Sujet introuvable.");
                    </script>
                    <?php
                    header("Refresh: 0; url=" . HOST . "sujetspdf");
                    exit();
                }

                $valeursPdf = [
                    'cc' => $sujetExistant->cc,
                    'sn' => $sujetExistant->sn,
                    'sr' => $sujetExistant->sr,
                    'bts' => $sujetExistant->bts,
                    'td' => $sujetExistant->td,
                    'tp' => $sujetExistant->tp,
                ];

                foreach ($examens as $colonne) {
                    if (isset($_FILES[$colonne]) && !empty($_FILES[$colonne]['name'])) {
                        $extension = strtolower(strrchr($_FILES[$colonne]['name'], "."));
                        if ($extension !== '.pdf') {
                            ?>
                            <script>
                                alert("Seuls les fichiers PDF sont autorisés pour <?= strtoupper($colonne); ?>.");
                            </script>
                            <?php
                            header("Refresh: 0; url=" . HOST . "sujetspdf");
                            exit();
                        }

                        $nouveauNom = basename($_FILES[$colonne]['name']);
                        $destination = ASSETS_ROOT . "uploads/docpdf/" . $nouveauNom;

                        if (!empty($sujetExistant->$colonne)) {
                            $ancienChemin = ASSETS_ROOT . "uploads/docpdf/" . $sujetExistant->$colonne;
                            if (is_file($ancienChemin)) {
                                @unlink($ancienChemin);
                            }
                        }

                        move_uploaded_file($_FILES[$colonne]['tmp_name'], $destination);
                        $valeursPdf[$colonne] = $nouveauNom;
                    }
                }

                $anneeValeur = $annee !== '' ? (int)$annee : null;
                $eec->updateSujetPdf(
                    $filiere,
                    $id,
                    $matiere,
                    $anneeValeur,
                    $niveau,
                    $valeursPdf['cc'],
                    $valeursPdf['sn'],
                    $valeursPdf['sr'],
                    $valeursPdf['bts'],
                    $valeursPdf['td'],
                    $valeursPdf['tp']
                );
                ?>
                <script>
                    alert("Sujet PDF modifié avec succès.");
                </script>
                <?php
                header("Refresh: 0; url=" . HOST . "sujetspdf");
                exit();
            }
        }

        $allSujets = [];
        foreach ($filieres as $cle => $libelle) {
            $sujets = $eec->afficherSujet($cle);
            if (!empty($sujets)) {
                foreach ($sujets as $sujet) {
                    $sujet->filiere = $cle;
                    $sujet->libelle_filiere = $libelle;
                    $allSujets[] = $sujet;
                }
            }
        }

        include(DOC_ADMINISTRATEUR . "sujetspdf.php");
    }

/*============================================================================================================================ */

    /*============================================================================================================================ */

    /**
     * Compresse un fichier PDF avec Ghostscript
     * 
     * @param string $fichierSource Chemin du fichier PDF source
     * @param string $fichierDestination Chemin du fichier PDF compressé
     * @param string $qualite Niveau de qualité : 'screen', 'ebook', 'printer', 'prepress'
     * @return bool True si compression réussie, False sinon
     */
    private function compresserPDFAvecGhostscript($fichierSource, $fichierDestination, $qualite = 'ebook') 
    {
        // Vérifier que le fichier source existe
        if (!file_exists($fichierSource)) {
            return false;
        }

        // Détection du système d'exploitation
        $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';

        // Chemins possibles pour Ghostscript selon le système
        $gsPaths = [];
        
        if ($isWindows) {
            // Chemins Windows (utiliser des doubles backslashes ou slashes)
            $gsPaths = [
                'C:\\Program Files\\gs\\gs10.06.0\\bin\\gswin64c.exe',
                'C:\\Program Files (x86)\\gs\\gs10.06.0\\bin\\gswin32c.exe',
                'C:\\Program Files\\gs\\gs10.04.0\\bin\\gswin64c.exe',
                'C:\\Program Files\\gs\\gs10.03.1\\bin\\gswin64c.exe',
                'C:\\Program Files\\gs\\gs10.02.1\\bin\\gswin64c.exe',
                'gswin64c.exe',  // Si dans PATH
                'gswin32c.exe',  // Si dans PATH
            ];
        } else {
            // Chemins Linux/Unix/macOS
            $gsPaths = [
                'gs',                    // Dans PATH
                '/usr/bin/gs',           // Chemin absolu standard
                '/usr/local/bin/gs',     // macOS/Linux alternatif
                '/opt/homebrew/bin/gs',  // macOS avec Homebrew (M1/M2)
            ];
        }

        // Trouver le chemin de Ghostscript disponible
        $gsPath = null;
        
        foreach ($gsPaths as $path) {
            if ($isWindows) {
                // Sur Windows : vérifier l'existence du fichier directement
                if (file_exists($path)) {
                    $gsPath = $path;
                    break;
                }
                // Sinon tester avec 'where' pour les exécutables dans PATH
                $test = shell_exec("where " . escapeshellarg(basename($path)) . " 2>nul");
                if ($test !== null && trim($test) !== '') {
                    $gsPath = trim(explode("\n", $test)[0]); // Prendre la première ligne
                    break;
                }
            } else {
                // Sur Linux/Unix : vérifier avec 'which' ou l'existence du fichier
                if (file_exists($path)) {
                    $gsPath = $path;
                    break;
                }
                $test = shell_exec("which " . escapeshellarg($path) . " 2>/dev/null");
                if ($test !== null && trim($test) !== '') {
                    $gsPath = trim($test);
                    break;
                }
            }
        }

        // Si Ghostscript n'est pas trouvé, retourner false
        if ($gsPath === null) {
            error_log("Ghostscript non trouvé sur le système. Compression PDF impossible.");
            return false;
        }

        // Niveaux de qualité disponibles
        $niveauxQualite = [
            'screen'   => '/screen',    // 72 dpi - Compression maximale (écran)
            'ebook'    => '/ebook',     // 150 dpi - Bon compromis (lecture numérique)
            'printer'  => '/printer',   // 300 dpi - Haute qualité (impression)
            'prepress' => '/prepress'   // 300+ dpi - Qualité maximale (pré-impression)
        ];

        $qualitePDF = $niveauxQualite[$qualite] ?? $niveauxQualite['ebook'];

        // Construction de la commande Ghostscript avec échappement correct
        $commande = sprintf(
            '%s -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=%s ' .
            '-dNOPAUSE -dQUIET -dBATCH -dDetectDuplicateImages=true ' .
            '-dCompressFonts=true -r150 -sOutputFile=%s %s 2>&1',
            escapeshellarg($gsPath),  // ✅ CORRECTION : Échapper le chemin Ghostscript
            $qualitePDF,
            escapeshellarg($fichierDestination),
            escapeshellarg($fichierSource)
        );

        // Exécution de la commande
        exec($commande, $output, $returnCode);

        // Vérifier si la compression a réussi
        if ($returnCode === 0 && file_exists($fichierDestination)) {
            // Vérifier que le fichier compressé n'est pas corrompu (taille > 0)
            if (filesize($fichierDestination) > 0) {
                return true;
            }
        }

        // Log de l'erreur si échec
        error_log("Erreur compression PDF: " . implode("\n", $output));
        return false;
    }
    /*============================================================================================================================
    
    /**
     * Affiche le formulaire d'insertion de PDF avec compression automatique
     */
    public function affichePageForm_insertionPDF()
    {
        require("connexionBd.php");
        require(MODEL_ROOT."ExercicesEtCorrections.class.php");
        require(MODEL_ROOT."fonctions.php");
        securiteAdmin();

        $eec = new ExercicesEtCorrections($connexionBd);
        if (isset($_POST["envoyer"])) {
            if (isset($_FILES) && !empty($_FILES)) 
            {
                $filiere = $_POST["filiere"];
                $matiere = $_POST["matiere"];
                $annee = $_POST["annee"];
                $niveau = isset($_POST["niveau"]) && !empty($_POST["niveau"]) ? (int) $_POST["niveau"] : null;
        
                // Validation du niveau
                if ($niveau !== null && ($niveau < 1 || $niveau > 3)) {
                    ?>
                    <script>
                        alert("Le niveau doit être entre 1 et 3.");
                    </script>
                    <?php
                    include(DOC_ADMINISTRATEUR ."form_insertionPDF.php");
                    return;
                }
        
                // Tableau pour stocker les fichiers valides
                $fichiersValides = [];
        
                // Fonction pour vérifier et traiter un fichier
                function traiterFichier($fichier, $nomChamp, &$fichiersValides) 
                {
                    if (!empty($fichier["name"])) {
                        $extension = strtolower(strrchr($fichier["name"], ".")); // Normalisation en minuscules
                        $extension_autoriser = [".pdf"]; // Extensions autorisées
        
                        if (in_array($extension, $extension_autoriser, true)) {
                            // Fichier valide, on l'ajoute au tableau
                            $fichiersValides[$nomChamp] = [
                                "nom" => $fichier["name"],
                                "tmp_name" => $fichier["tmp_name"],
                                "size" => $fichier["size"]
                            ];
                        } 
                        else 
                        {
                            // Fichier non valide, on affiche une alerte
                            ?>
                            <script>
                                alert("ATTENTION : Seul les fichiers PDF sont autorisés pour <?= $nomChamp ?>.");
                            </script>
                            <?php
                            return false; // Fichier non valide
                        }
                    }
                    return true; // Fichier valide ou vide
                }
        
                // Vérification de chaque fichier
                $ccValide = traiterFichier($_FILES["cc"], "cc", $fichiersValides);
                $snValide = traiterFichier($_FILES["sn"], "sn", $fichiersValides);
                $srValide = traiterFichier($_FILES["sr"], "sr", $fichiersValides);
                $tdValide = traiterFichier($_FILES["td"], "td", $fichiersValides);
                $tpValide = traiterFichier($_FILES["tp"], "tp", $fichiersValides);
        
                // Si tous les fichiers non vides sont valides, on procède à l'insertion
                if ($ccValide && $snValide && $srValide && $tdValide && $tpValide) {
                    // Préparation des données pour l'insertion
                    $cc = $fichiersValides["cc"]["nom"] ?? null;
                    $sn = $fichiersValides["sn"]["nom"] ?? null;
                    $sr = $fichiersValides["sr"]["nom"] ?? null;
                    $td = $fichiersValides["td"]["nom"] ?? null;
                    $tp = $fichiersValides["tp"]["nom"] ?? null;
        
                    // Insertion dans la base de données
                    $req_insertion = $eec->insererSujet($filiere, $matiere, $annee, $niveau, $cc, $sn, $sr, $td, $tp);
        
                    if ($req_insertion) {
                        // Compteurs pour statistiques
                        $nbFichiersCompresses = 0;
                        $tailleOriginale = 0;
                        $tailleFinale = 0;

                        // Déplacement et compression des fichiers vers le dossier de destination
                        foreach ($fichiersValides as $nomChamp => $fichier) 
                        {
                            $fichierTemp = $fichier["tmp_name"];
                            $nomFichier = $fichier["nom"];
                            $tailleOriginale += $fichier["size"];
                            
                            // Créer un fichier temporaire pour la compression
                            $fichierCompresse = sys_get_temp_dir() . '/compressed_' . uniqid() . '_' . $nomFichier;
                            
                            // Tenter la compression avec Ghostscript (qualité 'ebook' = bon compromis)
                            $compressionReussie = $this->compresserPDFAvecGhostscript($fichierTemp, $fichierCompresse, 'ebook');
                            
                            // Emplacement final du fichier
                            $emplacement_reel = ASSETS_ROOT . "uploads/docpdf/" . $nomFichier;
                            
                            if ($compressionReussie) {
                                // Utiliser le fichier compressé
                                $tailleCompresse = filesize($fichierCompresse);
                                $tailleFinale += $tailleCompresse;
                                
                                // Calculer le taux de compression
                                $pourcentageReduction = round((1 - ($tailleCompresse / $fichier["size"])) * 100, 1);
                                
                                // Déplacer le fichier compressé vers la destination finale
                                if (move_uploaded_file($fichierCompresse, $emplacement_reel) || 
                                    copy($fichierCompresse, $emplacement_reel)) {
                                    $nbFichiersCompresses++;
                                    @unlink($fichierCompresse); // Nettoyer le fichier temporaire
                                    
                                    error_log("PDF compressé : $nomFichier - Réduction : $pourcentageReduction%");
                                }
                            } else {
                                // Fallback : utiliser le fichier original si la compression échoue
                                $tailleFinale += $fichier["size"];
                                move_uploaded_file($fichierTemp, $emplacement_reel);
                                
                                error_log("Compression échouée pour $nomFichier - Fichier original utilisé");
                            }
                        }

                        // Calculer les statistiques globales
                        $reductionTotale = $tailleOriginale > 0 ? round((1 - ($tailleFinale / $tailleOriginale)) * 100, 1) : 0;
                        $gainEspace = round(($tailleOriginale - $tailleFinale) / 1024 / 1024, 2); // En Mo

                        ?>
                        <script>
                            alert("✅ Sujet PDF inséré avec succès !\n\n" +
                                  "📊 Statistiques de compression :\n" +
                                  "• Fichiers compressés : <?= $nbFichiersCompresses ?>\n" +
                                  "• Réduction totale : <?= $reductionTotale ?>%\n" +
                                  "• Espace économisé : <?= $gainEspace ?> Mo");
                        </script>
                        <?php
                    } else {
                        ?>
                        <script>
                            alert("❌ Erreur : sujet PDF non inséré dans la base de données.");
                        </script>
                        <?php
                    }
                }
            } 
            else 
            {
                ?>
                <script>
                    alert("⚠️ Aucun fichier PDF importé.");
                </script>
                <?php
            }
        }

        include(DOC_ADMINISTRATEUR ."form_insertionPDF.php");
    }

/*============================================================================================================================ */
public function affichePageForm_publierEEC()
{ 
    require("connexionBd.php");
    require(MODEL_ROOT."ExercicesEtCorrections.class.php");
    require(MODEL_ROOT."fonctions.php");
    securiteAdmin();

    if (isset($_POST["soumettre"])) {
        $eec = new ExercicesEtCorrections($connexionBd);
        $nom_mat_uti = $eec->filtrerDonnees($_POST["nom_mat"]);
        $id_uti=0;
        $titre_exe_uti = $eec->filtrerDonnees($_POST["titre_exe"]);
        $libelle_exe_uti = $eec->filtrerDonnees($_POST["libelle_exe"]);
        $titre_cor_uti = $eec->filtrerDonnees($_POST["titre_exe"]);
        $libelle_cor_uti = $eec->filtrerDonnees($_POST["libelle_cor"]);
        $date_pub_uti = date("Y-m-d");
        $heure_pub_uti = date("H-m-s");
        $lastInsertId_mat_uti = $eec->insererMatieresUtilisateurs($nom_mat_uti);
        $lastInsertId_exe_uti = $eec->insererExercicesUtilisateurs($titre_exe_uti, $libelle_exe_uti, $date_pub_uti, $heure_pub_uti, $lastInsertId_mat_uti, $id_uti);
        $eec->insererCorrectionsUtilisateurs($titre_cor_uti, $libelle_cor_uti, $date_pub_uti, $heure_pub_uti, $lastInsertId_exe_uti);
    }
    include(VIEW_ROOT."form_publierEEC.php");
}


/*============================================================================================================================ */    
   



}