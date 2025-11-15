<?php

/* declaration de classe
ExercicesEtCorrections
*/
class ExercicesEtCorrections
{
    private $connexionBd;

    // Le constructeur de la classe, prenant en paramètre la connexion à la base de données
    public function __construct($connexionBd)
    {
        $this->connexionBd = $connexionBd;
    }

    //methode d'insertion des sujets pdf
    public function insererSujet($filiere, $matiere, $annee, $cc, $sn, $sr, $td, $tp)
    {
        $req_inserer = $this->connexionBd->prepare("INSERT INTO $filiere (matiere, annee, cc, sn, sr, td, tp) VALUES (:matiere, :annee, :cc, :sn, :sr, :td, :tp)");
        $req_inserer->bindParam(':matiere', $matiere, PDO::PARAM_STR);
        $req_inserer->bindParam(':annee', $annee, PDO::PARAM_INT);
        $req_inserer->bindParam(':cc', $cc, PDO::PARAM_STR);
        $req_inserer->bindParam(':sn', $sn, PDO::PARAM_STR);
        $req_inserer->bindParam(':sr', $sr, PDO::PARAM_STR);
        $req_inserer->bindParam(':td', $td, PDO::PARAM_STR);
        $req_inserer->bindParam(':tp', $tp, PDO::PARAM_STR);
        $req_inserer->execute();
        return true;
    }

    // Méthode pour insérer dans la table 'matières'
    public function insererMatieres($nom_mat)
    {
        $req_inserer = $this->connexionBd->prepare("INSERT INTO matieres (nom_mat) VALUES (:nom_mat)");
        $req_inserer->bindParam(':nom_mat',  $nom_mat, PDO::PARAM_STR);
        $req_inserer->execute();
        return $this->connexionBd->lastInsertId();
    }
    public function insererMatieresUtilisateurs($nom_mat_uti)
    {
        $req_inserer = $this->connexionBd->prepare("INSERT INTO matieres_utilisateurs (nom_mat_uti) VALUES (:nom_mat_uti)");
        $req_inserer->bindParam(':nom_mat_uti',  $nom_mat_uti, PDO::PARAM_STR);
        $req_inserer->execute();
        return $this->connexionBd->lastInsertId();
    }


        // Méthode pour insérer une dans la table 'exercices'
        public function insererExercices($titre_exe, $libelle_exe, $fichier_exe, $date_pub_exe, $heure_pub_exe, $id_mat)
        {
            $req_inserer = $this->connexionBd->prepare("INSERT INTO exercices (titre_exe, libelle_exe, fichier_exe, date_pub_exe, heure_pub_exe, id_mat) VALUES (:titre_exe, :libelle_exe, :fichier_exe, CURDATE(), CURTIME(), :id_mat)");
            $req_inserer->bindParam(':titre_exe', $titre_exe, PDO::PARAM_STR);
            $req_inserer->bindParam(':libelle_exe',  $libelle_exe, PDO::PARAM_STR);
            $req_inserer->bindParam(':fichier_exe',  $fichier_exe, PDO::PARAM_STR);
            $req_inserer->bindParam(':id_mat', $id_mat, PDO::PARAM_INT);
            $req_inserer->execute();
            return $this->connexionBd->lastInsertId();
        }
        public function insererExercicesUtilisateurs($titre_exe_uti, $libelle_exe_uti, $date_pub_exe_uti, $heure_pub_exe_uti, $id_mat_uti)
        {
            $req_inserer = $this->connexionBd->prepare("INSERT INTO exercices_utilisateurs (titre_exe_uti, libelle_exe_uti, date_pub_exe_uti, heure_pub_exe_uti, id_mat_uti) VALUES (:titre_exe_uti, :libelle_exe_uti, CURDATE(), CURTIME(), :id_mat_uti)");
            $req_inserer->bindParam(':titre_exe_uti', $titre_exe_uti, PDO::PARAM_STR);
            $req_inserer->bindParam(':libelle_exe_uti',  $libelle_exe_uti, PDO::PARAM_STR);
            $req_inserer->bindParam(':id_mat_uti', $id_mat_uti, PDO::PARAM_INT);
            $req_inserer->execute();
            return $this->connexionBd->lastInsertId();
        }


            // Méthode pour insérer l'utilisateur
            // public function insererUtilisateurs($nom_uti, $prenom_uti, $mail_uti, $mdp_uti, $confirmation_mdp_uti)
            // {
            //     $req_inserer = $this->connexionBd->prepare("INSERT INTO utilisateurs (nom_uti, prenom_uti, email_uti, mdp_uti, confirmation_mdp_uti) VALUES (:nom_uti, :prenom_uti, :mail_uti, :mdp_uti, :confirmation_mdp_uti)");
            //     $req_inserer->bindParam(':nom_uti', $nom_uti, PDO::PARAM_STR);
            //     $req_inserer->bindParam(':prenom_uti',  $prenom_uti, PDO::PARAM_STR);
            //     $req_inserer->bindParam(':mail_uti', $mail_uti, PDO::PARAM_STR);
            //     $req_inserer->bindParam(':mdp_uti', $mdp_uti, PDO::PARAM_STR);
            //     $req_inserer->bindParam(':confirmation_mdp_uti', $confirmation_mdp_uti, PDO::PARAM_STR);
            //     $req_inserer->execute();
            // }



            // Méthode pour insérer dans la table 'corrections'
            public function insererCorrections($titre_cor, $libelle_cor, $fichier_cor, $date_pub_cor, $heure_pub_cor, $id_exe)
            {
                $req_inserer = $this->connexionBd->prepare("INSERT INTO corrections (titre_cor, libelle_cor, fichier_cor, date_pub_cor, heure_pub_cor, id_exe) VALUES (:titre_cor, :libelle_cor, :fichier_cor, CURDATE(), CURTIME(), :id_exe)");
                $req_inserer->bindParam(':titre_cor', $titre_cor, PDO::PARAM_STR);
                $req_inserer->bindParam(':libelle_cor',  $libelle_cor, PDO::PARAM_STR);
                $req_inserer->bindParam(':fichier_cor', $fichier_cor, PDO::PARAM_STR);
                $req_inserer->bindParam(':id_exe', $id_exe, PDO::PARAM_INT);
                $req_inserer->execute();
            }
            public function insererCorrectionsUtilisateurs($titre_cor_uti, $libelle_cor_uti, $date_pub_cor_uti, $heure_pub_cor_uti, $id_exe_uti)
            {
                $req_inserer = $this->connexionBd->prepare("INSERT INTO corrections_utilisateurs (titre_cor_uti, libelle_cor_uti, date_pub_cor_uti, heure_pub_cor_uti, id_exe_uti) VALUES (:titre_cor_uti, :libelle_cor_uti, CURDATE(), CURTIME(), :id_exe_uti)");
                $req_inserer->bindParam(':titre_cor_uti', $titre_cor_uti, PDO::PARAM_STR);
                $req_inserer->bindParam(':libelle_cor_uti',  $libelle_cor_uti, PDO::PARAM_STR);
                $req_inserer->bindParam(':id_exe_uti', $id_exe_uti, PDO::PARAM_INT);
                $req_inserer->execute();
            }



    /* Methode pour afficher les donnees des tables */
    public function afficherTables()
    {
        $req_affiche = $this->connexionBd->query(' SELECT * FROM matieres
                                                            INNER JOIN exercices ON matieres.id_mat = exercices.id_mat
                                                            INNER JOIN corrections ON exercices.id_exe = corrections.id_exe
                                                            ORDER BY matieres.id_mat DESC                       
                                                ');
        $donnees = $req_affiche->fetchAll(PDO::FETCH_OBJ);
        return $donnees;
    }
        public function afficherDonneesUtilisateurs()
        {
            $req_affiche = $this->connexionBd->query(' SELECT * FROM matieres_utilisateurs
                                                                INNER JOIN exercices_utilisateurs ON matieres_utilisateurs.id_mat_uti = exercices_utilisateurs.id_mat_uti
                                                                INNER JOIN corrections_utilisateurs ON exercices_utilisateurs.id_exe_uti = corrections_utilisateurs.id_exe_uti
                                                                ORDER BY matieres_utilisateurs.id_mat_uti DESC                       
                                                    ');
            $donnees = $req_affiche->fetchAll(PDO::FETCH_OBJ);
            return $donnees;
        }
            //methode d'affichage des sujets pdf
            public function afficherSujet($filiere)
            {
                $sql = "SELECT * FROM $filiere ORDER BY annee DESC";
                $req_affiche = $this->connexionBd->query($sql);
                $donnees = $req_affiche->fetchAll(PDO::FETCH_OBJ);
                return $donnees;
            }
            public function afficherSujetExamen($examen, $filiere)
            {
                // Liste des colonnes d'examen valides pour éviter les injections SQL
                $examensValides = ['cc', 'sn', 'sr', 'bts', 'td', 'tp'];
                if (!in_array($examen, $examensValides)) {
                    return [];
                }
                
                // Liste des filières valides
                $filieresValides = ['gi', 'mcd', 'cf', 'lt', 'edd', 'grh', 'dcj', 'scienceid'];
                if (!in_array($filiere, $filieresValides)) {
                    return [];
                }
                
                // Sécurisation des noms de colonnes et de table avec des backticks
                // Filtrer pour ne montrer que les lignes où le champ d'examen n'est pas NULL
                $sql = "SELECT `id`, `matiere`, `annee`, `$examen` FROM `$filiere` WHERE `$examen` IS NOT NULL AND `$examen` != '' ORDER BY `annee` DESC";
            
                // Utilisation d'une requête préparée pour éviter les injections SQL
                $req_affiche = $this->connexionBd->query($sql);
                $req_affiche->execute();
            
                // Récupération des résultats
                $donnees = $req_affiche->fetchAll(PDO::FETCH_OBJ);
                return $donnees;
            }
                public function ligneFichierPDF($examen, $filiere, $id_pdf)
                {
                    // Liste des colonnes d'examen valides pour éviter les injections SQL
                    $examensValides = ['cc', 'sn', 'sr', 'bts', 'td', 'tp'];
                    if (!in_array($examen, $examensValides)) {
                        return null;
                    }
                    
                    // Liste des filières valides
                    $filieresValides = ['gi', 'mcd', 'cf', 'lt', 'edd', 'grh', 'dcj', 'scienceid'];
                    if (!in_array($filiere, $filieresValides)) {
                        return null;
                    }
                    
                    // Utilisation de backticks pour sécuriser les noms de colonnes et table
                    $req = $this->connexionBd->prepare("SELECT `$examen` FROM `$filiere` WHERE `id` = :id_pdf ");
                    $req->bindParam(":id_pdf", $id_pdf, PDO::PARAM_INT);
                    $req->execute();
                    $donnee = $req->fetch(PDO::FETCH_OBJ);
                    return $donnee;
                }
                
    // fonction de tri pour la barre de recherche sur la banniere du site initialiser sur la colone 'nom_mat' de la table matiere de la bd
    public function executerRecherche($nom_mat)
    {
        $req_affiche = $this->connexionBd->prepare('SELECT *
                                                    FROM matieres
                                                    INNER JOIN exercices ON matieres.id_mat = exercices.id_mat
                                                    INNER JOIN corrections ON exercices.id_exe = corrections.id_exe
                                                    WHERE matieres.nom_mat LIKE :nom_mat
                                                    ORDER BY exercices.id_exe DESC');
        $nom_mat_param = '%' . $nom_mat . '%';
        $req_affiche->bindParam(':nom_mat', $nom_mat_param, PDO::PARAM_STR);
        $req_affiche->execute();

        $donnees = $req_affiche->fetchAll(PDO::FETCH_OBJ);
        return $donnees;
    }

    //Methode pour sucuriser les donnees recuperer par les formulaire ou les donnees inserer sur l'url en les filtrant 
    public function filtrerDonnees($donnee)
    {
        $donnee = trim($donnee); //cette fonction permet de supprimer les espaces initules inserer dans le texte
        $donnee = strip_tags($donnee); // cette fonction permet de rendre inactive l'insertion des balises ou scripts 
        $donnee = stripslashes($donnee); //celle ci parmet d'annuler la proprieter d'echappement de l'anti-slash
        $donnee = htmlspecialchars($donnee); // pour conclure une fonction pour le filtrage
        return $donnee;
    }

    /*une methode pour obtenir les details d'un exercice en fonction de son id*/
    public function getExerciceCorrectionDetails($id_exe_uti)
    {
        $req_details = $this->connexionBd->prepare("SELECT * FROM matieres_utilisateurs
                                                    INNER JOIN exercices_utilisateurs  ON matieres_utilisateurs.id_mat_uti =  exercices_utilisateurs.id_mat_uti
                                                    INNER JOIN corrections_utilisateurs ON exercices_utilisateurs.id_exe_uti = corrections_utilisateurs.id_cor_uti
                                                    WHERE exercices_utilisateurs.id_exe_uti = :id_exe_uti");
        $req_details->bindParam(':id_exe_uti', $id_exe_uti, PDO::PARAM_INT);
        $req_details->execute();
        $details = $req_details->fetch(PDO::FETCH_OBJ);
        return $details;
    }

    //methode pour obtenir les details de la correction
    public function getCorrectionDetails($id_cor_uti)
    {
        $req_details = $this->connexionBd->prepare("SELECT * FROM corrections_utilisateurs WHERE id_cor_uti = :id_cor_uti");
        $req_details->bindParam(':id_cor_uti', $id_cor_uti, PDO::PARAM_INT);
        $req_details->execute();
        $details = $req_details->fetch(PDO::FETCH_OBJ);
        return $details;
    }

    // public function supprimerExcerciceCorrection($id)
    // {
    //    $req_supprimer = $this->connexionBd->query("DELETE FROM exercices_utilisateurs, corrections_utilisateurs WHERE id_exe_uti = :id_exe_uti AND id_cor_uti = :id_cor_uti");
    //    $req_supprimer->bindParam(':id_exe_uti', $id, PDO::PARAM_INT);
    //    $req_supprimer->bindParam(':id_cor_uti', $id, PDO::PARAM_INT);
    //    $req_supprimer->execute(); 
    // }

    public function supprimerExcerciceCorrection($id)
    {
        $req_supprimer = $this->connexionBd->prepare("DELETE FROM matieres_utilisateurs WHERE id_mat_uti = :id ");
        $req_supprimer->bindParam(':id', $id, PDO::PARAM_INT);
        $req_supprimer->execute(); 
    }

    public static function req_selectionContenuTable($nomTable)
    {
        require("connexionBd.php");
        $query = "SELECT * FROM $nomTable";
        $req = $connexionBd->query($query);
        $req->execute();
        $donnees = $req->fetch(PDO::FETCH_OBJ);
        return $donnees;
    } 

    public static function cacheLesMenusReserverAdmin()
    {
        require("connexionBd.php");
        $utilisateur = "utilisateurs";
        $tableUtilisateur = ExercicesEtCorrections::req_selectionContenuTable($utilisateur);
        $admin = "admin";
        $tableAdministrateur = ExercicesEtCorrections::req_selectionContenuTable($admin);
    
        if($tableUtilisateur && @$_SESSION['auth'] == $tableUtilisateur->email_uti)
        { ?>
            <!--******* SCRIPT POUR CACHER L'ACCES AUX FORMULAIRE_ADMIN AINSI QUE LE FORMULAIFRE_INSERTIONPDF AUX UTILISATEURS *******-->
            <script>
                var menuAdmin1 = document.getElementById('form_admin');
                var menuAdmin2 = document.getElementById('form_insertion');
                if(menuAdmin1)
                {
                    menuAdmin1.style.display='none';
                    menuAdmin2.style.display='none';
                }
            </script>
<?php  } 

        elseif($tableAdministrateur && @$_SESSION['admin'] == $tableAdministrateur->email_adm)
        { ?>
            <!--******* SCRIPT POUR AFFICHER LES MENUS ADMIN AUX ADMINISTRATEURS *******-->
            <script>
                var menuAdmin1 = document.getElementById('form_admin');
                var menuAdmin2 = document.getElementById('form_insertion');
                if(menuAdmin1)
                {
                    // Les menus admin sont visibles pour les administrateurs
                }
            </script>
<?php  }
        else
        { ?>
            <!--******* SCRIPT POUR CACHER L'ACCES AUX FORMULAIRE_ADMIN AINSI QUE LE FORMULAIFRE_INSERTIONPDF AUX VISITEURS *******-->
            <script>
                var menuAdmin1 = document.getElementById('form_admin');
                var menuAdmin2 = document.getElementById('form_insertion');
                if(menuAdmin1)
                {
                    menuAdmin1.style.display='none';
                    menuAdmin2.style.display='none';
                }
            </script>
<?php  }
    }



    

/*--------------------------------------------
    SYSTEME DE GESTION DES UTILISATEURS CBS
--------------------------------------------*/
/*============================================================================================================================ */
    
// Méthode pour insérer l'etudiant dans une table a etulisation temporaire avant suppression des donnees
public function insererEtudiantCbsTemp($prenom_etu, $email_etu, $carte_etu, $identifiant_etu)
{
    $req_inserer = $this->connexionBd->prepare("
    INSERT INTO etudiant_cbs_temp (prenom_etu, email_etu, carte_etu, identifiant_etu, date_inscription_etu) 
    VALUES (:prenom_etu, :email_etu, :carte_etu, :identifiant_etu, CURDATE())
    ");
    $req_inserer->bindParam(':prenom_etu', $prenom_etu, PDO::PARAM_STR);
    $req_inserer->bindParam(':email_etu', $email_etu, PDO::PARAM_STR);
    $req_inserer->bindParam(':carte_etu', $carte_etu, PDO::PARAM_STR);
    $req_inserer->bindParam(':identifiant_etu', $identifiant_etu, PDO::PARAM_STR);
    $req_inserer->execute();
    return true;
}

    public function afficherEtudiantsCbs()
    {
        $req = $this->connexionBd->query("SELECT * FROM etudiant_cbs");
        $req->execute();
        $users = $req->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }

            public function supprimerEtudiantCbsTemp($id)
            {
                $req_supprimer = $this->connexionBd->prepare("DELETE FROM etudiant_cbs_temp WHERE id_etu = :id ");
                $req_supprimer->bindParam(':id', $id, PDO::PARAM_INT);
                $req_supprimer->execute();

                return true;
            }
/*============================================================================================================================*/







    // //methode pour la mise a jour de detail d'un correction
    // public function updateCorrection($id_cor_uti, $nouveaux_details_uti)
    // {
    //     $req_update = $this->connexionBd->prepare("UPDATE corrections_utilisateurs SET libelle_cor_uti = :libelle_uti, WHERE id_cor_uti = :id_cor_uti");
    //     $req_update->bindParam(':id_cor_uti', $id_cor_uti, PDO::PARAM_INT);
    //     $req_update->bindParam(':titre_cor_uti', $nouveaux_details_uti['titre'], PDO::PARAM_STR);
    //     $req_update->bindParam(':libelle_uti', $nouveaux_detail_utis['libelle'], PDO::PARAM_STR);
    //     $req_update->execute();
    // }
    //     //methode pour la mise a jour de detail d'un exercice
    //     public function updateExercice($id_exe_uti, $nouveaux_details_uti)
    //     {
    //         $req_update = $this->connexionBd->prepare("UPDATE exercices_utilisateurs
    //                                                      INNER JOIN matieres_utilisateurs ON exercices_utilisateurs.id_mat_uti = matieres_utilisateurs.id_mat_uti
    //                                                      SET nom_mat_uti = :nom_mat_uti,
    //                                                          titre_exe_uti = :titre_exe_uti, 
    //                                                          libelle_exe_uti = :libelle_exe_uti, 
    //                                                      WHERE id_exe_uti = :id_exe_uti");
    //         $req_update->bindParam(':id_exe_uti', $id_exe, PDO::PARAM_INT);
    //         $req_update->bindParam(':nom_mat_uti', $nouveaux_details_uti['matiere'], PDO::PARAM_STR);
    //         $req_update->bindParam(':titre_exe_uti', $nouveaux_details_uti['titre'], PDO::PARAM_STR);
    //         $req_update->bindParam(':libelle_exe_uti', $nouveaux_details_uti['libelle'], PDO::PARAM_STR);
    //         $req_update->execute();
    //     }*/

}
