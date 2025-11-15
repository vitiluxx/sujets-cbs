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
    public function affichePageDashboard()
    {
        require("connexionBd.php");
        require(MODEL_ROOT."ExercicesEtCorrections.class.php");
        $eec = new ExercicesEtCorrections($connexionBd);
        require(MODEL_ROOT."fonctions.php");
        securiteAdmin();
      
        include(DOC_ADMINISTRATEUR . "dashboard.php");
    
    }
    /*============================================================================================================================ */  
    public function affichePageDemandesInscription()
    {
        // Connexion à la base de données
        require("connexionBd.php");
        require(MODEL_ROOT."ExercicesEtCorrections.class.php");
        $eec = new ExercicesEtCorrections($connexionBd);
        require(MODEL_ROOT."fonctions.php");
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
                    //     header("Location: " . HOST . "demandesinscription");
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

        include(DOC_ADMINISTRATEUR . "demandesinscription.php");
    
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
        ExercicesEtCorrections::cacheLesMenusReserverAdmin();
    }

/*============================================================================================================================ */

public function affichePageZoneSuperviseur() 
{                        
    require("connexionBd.php");
    require(MODEL_ROOT."ExercicesEtCorrections.class.php");
    require(MODEL_ROOT."fonctions.php");
    securiteAdmin();

    $eec = new ExercicesEtCorrections($connexionBd);
        
    $table = $eec->afficherDonneesUtilisateurs();
    $count = 0;
    include(DOC_SUPERVISEUR."zoneSuperviseur.php");
    ExercicesEtCorrections::cacheLesMenusReserverAdmin();
}

/*============================================================================================================================ */

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
                                "tmp_name" => $fichier["tmp_name"]
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
                    $req_insertion = $eec->insererSujet($filiere, $matiere, $annee, $cc, $sn, $sr, $td, $tp);
        
                    if ($req_insertion) {
                        // Déplacement des fichiers vers le dossier de destination
                        foreach ($fichiersValides as $nomChamp => $fichier) 
                        {
                            $emplacement_reel = ASSETS_ROOT . "uploads/docpdf/" . $fichier["nom"];
                            move_uploaded_file($fichier["tmp_name"], $emplacement_reel);
                        }
                        ?>
                        <script>
                            alert("Sujet PDF inséré avec succès.");
                        </script>
                        <?php
                    } else {
                        ?>
                        <script>
                            alert("Erreur : sujet PDF non inséré.");
                        </script>
                        <?php
                    }
                }
            } 
            else 
            {
                echo "Aucun fichier PDF importé.";
            }
        }

        include(DOC_ADMINISTRATEUR ."form_insertionPDF.php");
        ExercicesEtCorrections::cacheLesMenusReserverAdmin();
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
    ExercicesEtCorrections::cacheLesMenusReserverAdmin();
}


/*============================================================================================================================ */    
   



}