<?php
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
class Controller
{
        /*============================================================================================================================ */    
                             
        // DÉSACTIVÉE - La table utilisateurs n'existe plus
        // Cette méthode était utilisée pour l'inscription des utilisateurs normaux
        // Les étudiants CBS utilisent maintenant affichePageForm_inscriptionEtudiantCbs()
        public function affichePageForm_inscriptionUtilisateur()
        {
            // Redirection vers la page d'inscription CBS car la table utilisateurs n'existe plus
            header("Location: " . HOST . "form_inscriptionCbs");
            exit();
            
            /* CODE DÉSACTIVÉ - Table utilisateurs supprimée
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");

            if ($_SERVER["REQUEST_METHOD"] === "POST") 
            {
                require("connexionBd.php");
                require(MODEL_ROOT."fonctions.php");
                if (!empty($_POST)) 
                {

                    $errors = [];
                    
                    // Nom
                    if (empty($_POST['identifiant_etu']) || !preg_match("#^[a-zA-Z0-9_]+$#", $_POST['identifiant_etu'])) {
                    $errors['identifiant_etu'] = "Votre nom n'est pas valide";
                    // var_dump($errors['identifiant_etu']);
                    //die();
                    ?>
                        <script> alert("Votre nom n'est pas valide")</script>
                    <?php
                        
                    }
                        
                    else {
                    // SELECT * FROM users WHERE username = post
                    $query = "SELECT * FROM utilisateurs WHERE identifiant_etu = ?";
                    $req = $connexionBd->prepare($query);
                    $req->execute([$_POST['identifiant_etu']]);
                    if ($req->fetch()) {
                    $errors['identifiant_etu'] = "Ce nom a déjà été utilisé entrez un nom valide";
                    //var_dump($errors['identifiant_etu']);
                    ?>
                        <script> alert("Ce nom a déjà été utilisé entrez un nom valide")</script>
                    <?php
                        }
                    }

                    // Prénom
                    if (empty($_POST['prenom_etu']) || !preg_match("#^[a-zA-Z0-9_]+$#", $_POST['prenom_etu'])) {
                    $errors['prenom_etu'] = "Votre prénom n'est pas valide";
                    //var_dump($errors['prenom_etu']);
                    //die();
                        ?>
                            <script> alert("Votre prénom n'est pas valide")</script>
                        <?php
                    } else {
                    // SELECT * FROM users WHERE username = post
                    $query = "SELECT * FROM utilisateurs WHERE prenom_etu = ?";
                    $req = $connexionBd->prepare($query);
                    $req->execute([$_POST['prenom_etu']]);
                    if ($req->fetch()) {
                    ?>
                        <script> alert("Ce prenom a déjà été utilisé")</script>
                    <?php

                        }
                    }

                    //Cette requête permettant de vérifier si l'adress mail entrée existe déjà dans la base de données
                    $query = "SELECT * FROM utilisateurs WHERE email_etu = ?";
                    $req = $connexionBd->prepare($query);
                    $req->execute([$_POST['email_etu']]);
                    if ($req->fetch()) {
                    $errors['email_etu'] = "Cet email est déjà pris";
                    ?>
                        <script> alert("Cet email est déjà pris")</script>
                    <?php
                    //var_dump($errors['email_etu']);
                    }


                    // Password
                    if (empty($_POST['mdp_uti']) || $_POST['mdp_uti'] !== $_POST['confirmation_mdp_uti']) {
                    $errors['mdp_uti'] = "Vous devez entrer un mot de passe valide et confirmé";
                    ?>
                        <script> alert("Vous devez entrer un mot de passe valide et confirmé")</script>
                    <?php
                    //var_dump($errors['mdp_uti']);
                    }
                        
                    if (empty($errors)) {
                    
                    
                    $query = "INSERT INTO utilisateurs(identifiant_etu, prenom_etu, email_etu, mdp_uti, confirmation_mdp_uti) VALUES(?,?,?,?,?)";
                    $req = $connexionBd->prepare($query);
                    $mdp_uti = password_hash($_POST['mdp_uti'], PASSWORD_BCRYPT);

                    $token = generateToken(100);
                    
                    $creationCompteValide = $req->execute([$_POST['identifiant_etu'], $_POST['prenom_etu'], $_POST['email_etu'], $mdp_uti, $token]);
                    // echo $verif;exit;

                    $userId = $connexionBd->lastInsertId();

                
                    $mail = $_POST['email_etu'];
                    $subject = "Confirmation du compte";
                    $message = "Afin de confirmer votre compte, merci de cliquer sur ce lien \n\n".
                    HOST."confirmation.php?id=$userId&token=$token";


                    mail($mail, $subject, $message);

                    // $_SESSION['flash']['success'] = "Compte créé avec succès. Veuillez vérifier votre boîte mail afin de confirmer votre compte";
                    
                    header("Location: " . HOST . "form_connexionUtilisateur.php");
                    if(isset($creationCompteValide))
                    {
                        ?>
                            <script> alert("Compte créé avec succès. Veuillez vérifier votre boîte mail afin de confirmer votre compte"); </script>
                        <?php
                    }
                    exit();
                }
            }
            }
            include(VIEW_ROOT."form_inscriptionUtilisateur.php");
            */
        }

        /*============================================================================================================================ */                            


        /*============================================================================================================================ */                            

        // DÉSACTIVÉE - La table utilisateurs n'existe plus
        // Cette méthode était utilisée pour confirmer les comptes utilisateurs
        public function affichePageConfirmation()
        {   
            // Redirection car la table utilisateurs n'existe plus
            header("Location: " . HOST . "form_connexionUtilisateur.php");
            exit();
        }

/*============================================================================================================================ */                            

public function affichePageForm_connexionUtilisateur() 
{
    require(MODEL_ROOT . "ExercicesEtCorrections.class.php");
    $error = null;

    try {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            require("connexionBd.php");
            $eec = new ExercicesEtCorrections($connexionBd);

            $email = strtolower($eec->filtrerDonnees($_POST["email_uti"]));
            $mdp = $eec->filtrerDonnees($_POST["mdp_uti"]);

            if (empty($email) || empty($mdp)) {
                $error = "L'email et le mot de passe sont requis.";
            } else {
                $admin = $this->getAdminByEmail($connexionBd, $email);

                if ($admin && $email === $admin->email_adm) {
                    $this->connecterAdmin($connexionBd, $email, $mdp); // redirige si OK
                } else {
                    $error = "Identifiants incorrects ou administrateur non trouvé.";
                }
            }
        }

    } catch (Exception $e) {
        $error = $e->getMessage(); // Capture erreur
    }

    // ✅ Affichage du formulaire avec erreur potentielle
    include(VIEW_ROOT . "form_connexionUtilisateur.php");
}


// Méthode pour récupérer un admin par email
private function getAdminByEmail($connexionBd, $email) {
    $query = "SELECT * FROM admin WHERE email_adm = :email";
    $req = $connexionBd->prepare($query);
    $req->bindParam(":email", $email, PDO::PARAM_STR);
    $req->execute();
    return $req->fetch(PDO::FETCH_OBJ) ?: null; // Retourne null si aucun résultat
}

// Méthode pour connecter un admin
private function connecterAdmin($connexionBd, $email, $mdp) {
    $admin = $this->getAdminByEmail($connexionBd, $email);

    // Supposons que le mot de passe admin soit aussi hashé
    if ($admin && password_verify($mdp, $admin->mdp_adm)) {
        $_SESSION['admin'] = $admin;
        $_SESSION['role'] = 'admin';
        $_SESSION['flash']['success'] = "Connexion SuperRoot effectuée avec succès.";
        header("Location: " . HOST . "dashboard");
        exit();
    } else {
        throw new Exception("Identifiant ou mot de passe Admin incorrect.");
    }
}

/*============================================================================================================================ */

        public function affichePageForm_inscriptionCbs()
        {
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");

            if ($_SERVER["REQUEST_METHOD"] === "POST") 
            {
                require("connexionBd.php");
                require(MODEL_ROOT."fonctions.php");

                if (!empty($_POST)) 
                {
                    $errors = [];

                    // Nom complet
                    if (empty($_POST['nom_complet']) || !preg_match("/^[a-zA-Z\s]+$/", $_POST['nom_complet'])) {
                        $errors['nom_complet'] = "Votre nom complet n'est pas valide";
                        echo "<script>alert('Votre nom complet n\'est pas valide');</script>";
                    }

                    // Vérification d'adresse e-mail
                    $query = "SELECT * FROM utilisateurs WHERE email_uti = ?";
                    $req = $connexionBd->prepare($query);
                    $req->execute([$_POST['email_uti']]);
                    if ($req->fetch()) {
                        $errors['email_uti'] = "Cet email est déjà pris";
                        echo "<script>alert('Cet email est déjà pris');</script>";
                    }

                    // Vérification de l'image
                    if (isset($_FILES['image_uti']) && $_FILES['image_uti']['error'] == 0) {
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        if (!in_array($_FILES['image_uti']['type'], $allowedTypes)) {
                            $errors['image_uti'] = "Format d'image non pris en charge";
                            echo "<script>alert('Format d\'image non pris en charge');</script>";
                        } else {
                            $imagePath = 'uploads/' . basename($_FILES['image_uti']['name']);
                            move_uploaded_file($_FILES['image_uti']['tmp_name'], $imagePath);
                        }
                    }

                    if (empty($errors)) {
                        $query = "INSERT INTO utilisateurs(nom_complet, email_uti, image_uti) VALUES(?,?,?)";
                        $req = $connexionBd->prepare($query);
                        $mdp_uti = password_hash($_POST['mdp_uti'], PASSWORD_BCRYPT);
                        $token = generateToken(100);

                        $creationCompteValide = $req->execute([$_POST['nom_complet'], $_POST['email_uti'], $imagePath, $mdp_uti, $token]);

                        $userId = $connexionBd->lastInsertId();
                        $mail = $_POST['email_uti'];
                        $subject = "Confirmation du compte";
                        $message = "Afin de confirmer votre compte, cliquez sur ce lien\n\n" . HOST . "confirmation.php?id=$userId&token=$token";
                        mail($mail, $subject, $message);

                        header("Location: " . HOST . "form_connexionUtilisateur.php");
                        echo "<script>alert('Compte créé avec succès. Veuillez vérifier votre boîte mail pour confirmer votre compte');</script>";
                        exit();
                    }
                }
            }
            include(VIEW_ROOT."form_inscriptionUtilisateur.php");
        }




/*============================================================================================================================ */    

public function affichePageDeconnexionUtilisateur()
{
    require("connexionBd.php");
    require(MODEL_ROOT."fonctions.php");

    startSessionIfNotStarted();
    
    // Supprimer toutes les données de session
    $_SESSION = array();
    
    // Supprimer le cookie de session s'il existe
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Supprimer le cookie de connexion automatique
    if (isset($_COOKIE['connexion_auto'])) {
        setcookie('connexion_auto', '', time() - 3600, '/');
    }
    
    // Détruire complètement la session
    session_unset();
    session_destroy();
    
    // Empêcher la mise en cache de la page de déconnexion
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    
    header("Location: ".HOST."form_connexionUtilisateur");
    exit();
    
}
/*============================================================================================================================ */  



        public function affichePageform_mdp_oublier()
        {          
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            require(MODEL_ROOT."fonctions.php");
            
            if (!empty($_POST) && !empty($_POST['email_uti'])) {
                $req = $connexionBd-> prepare( 'SELECT * FROM utilisateurs WHERE email_uti =? AND confirmation_compte_uti IS NOT NULL' );
                $req->execute([$_POST['email_uti']]);
            
                $user = $req->fetch();
            
                if ($user) {
                    session_start();
                    $reset_token = generateToken(100);
                    $connexionBd->prepare('UPDATE utilisateurs SET reset_token = ?, reset_at = NOW() WHERE id_uti =?')->execute([$reset_token, $user['id_uti']]);        
                
                    $mail = $_POST['email_uti'];
                    $subject = "Réinitialisation de votre mot de passe";
                    $message = "Afin de réinitialiser votre mot de passe, merci de cliquer sur ce lien \n\n"
                    .HOST."reinitialisation_mdp.php?id={$user['id_uti']}&token=$reset_token";
            
                    mail($mail, $subject, $message);
            
                    $_SESSION['flash']['success'] = "Les intructions du rappel de mot de passe vous ont été envoyées par email";
                    header("Location: ".HOST."form_connexionUtilisateur.php");
                    exit();
                } else {
                    $_SESSION['flash']['danger'] = "Aucun compte ne correspond à cette adresse";
                    
                }
            }
            
            include(VIEW_ROOT."form_mdp_oublier.php");
        }

        /*============================================================================================================================ */


        public function affichePageReinitialisation_mdp()
        {        
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            require(MODEL_ROOT."fonctions.php");
            
            if (isset($_GET['id']) && isset($_GET['token'])) {

                $userId = $_GET['id'];
                $token = $_GET['token'];
                $query = "SELECT * FROM utilisateurs WHERE id_uti = ?";
                $req = $connexionBd->prepare($query);
                $req->execute([$userId]);
            
                $user = $req->fetch();
            
                if ($user) {
                    if (!empty($_POST)) {
                        if (!empty($_POST['password']) || $_POST['password'] == $_POST['password_confirm']) {
                            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                            $query = "UPDATE utilisateurs SET mdp_uti = ?,reset_token = NULL,reset_at = NULL WHERE id_uti = ?";
                            $connexionBd->prepare($query)->execute([$password, $userId]);
            
                            $_SESSION['flash']['success'] = "Votre mot de passe a bien été mis à jour";
                            $_SESSION['auth'] = $user;
                            header("Location: " . HOST . "form_publierEEC.php");
                            exit();
                        } else {
                            $_SESSION['flash']['danger'] = "Les deux mots de passes ne correspondent pas !";
                        }
                    }
                } else {
                    $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
                    header("Location: " . HOST . "form_connexionUtilisateur.php");
                    exit();
                }
            } else {
                header("Location: " . HOST . "form_connexionUtilisateur.php");
                exit();
            }
            
            include(VIEW_ROOT."reinitialisation_mdp.php");
        }

        /*============================================================================================================================ */

        public function affichePageCc()
        {
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            $eec = new ExercicesEtCorrections($connexionBd);
            include(CEFODBUSINESSSCHOOL_ROOT."cc.php");
        } 

        /*============================================================================================================================ */

        public function affichePageSn()
        {
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            $eec = new ExercicesEtCorrections($connexionBd);

            include_once(CEFODBUSINESSSCHOOL_ROOT."sn.php");
        } 

        /*============================================================================================================================ */

        public function affichePageSr()                 
        {
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            $eec = new ExercicesEtCorrections($connexionBd);

            include_once(CEFODBUSINESSSCHOOL_ROOT."sr.php");
        }

        /*============================================================================================================================ */

        public function affichePageBts(){
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            $eec = new ExercicesEtCorrections($connexionBd);

            include_once(CEFODBUSINESSSCHOOL_ROOT."bts.php");
        }

        /*============================================================================================================================ */

        public function affichePageTd()
        {
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            $eec = new ExercicesEtCorrections($connexionBd);

            include_once(CEFODBUSINESSSCHOOL_ROOT."td.php");
        } 

/*============================================================================================================================ */

        public function affichePageTp()
        {
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            $eec = new ExercicesEtCorrections($connexionBd);
            include_once(CEFODBUSINESSSCHOOL_ROOT."tp.php");
        }

/*============================================================================================================================ */

        public function affichePageForm_modifierExerciceUtilisateur()
        {
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            require(MODEL_ROOT."fonctions.php");
            securiteAdmin();

            //Recuperation de l'exercice a modifier
            if (isset($_GET["id"])) 
            {
                $id = $_GET["id"];
                $eec = new ExercicesEtCorrections($connexionBd);
                $exercices = $eec->getExerciceCorrectionDetails($id);
            
                $id_exe_uti = $exercices->id_exe_uti;
                $nom_mat_uti = $exercices->nom_mat_uti;
                $titre_exe_uti = $exercices->titre_exe_uti;
                $libelle_exe_uti = $exercices->libelle_exe_uti;
            
                $id_cor_uti = $exercices->id_cor_uti;
                $titre_cor_uti = $exercices->titre_cor_uti;
                $libelle_cor_uti = $exercices->libelle_cor_uti;
            
            } 
            else 
            {
                echo "erreur: l'ID n'est pas recuperer";
            } 
                if(isset($_POST["publier"]))
                {
                    $id = (int) $eec->filtrerDonnees($_POST["id"]);
            
                    $nom_mat = $eec->filtrerDonnees($_POST["nom_mat"]);
            
            
                    $titre_exe = $eec->filtrerDonnees($_POST["titre_exe"]);
                    $libelle_exe = $eec->filtrerDonnees($_POST["libelle_exe"]);
            
                    $titre_cor = $eec->filtrerDonnees($_POST["titre_exe"]);
                    $libelle_cor = $eec->filtrerDonnees($_POST["libelle_cor"]);
                    $fichier=NULL;
            
                    $date_pub = date("Y-m-d");
                    $heure_pub = date("H-m-s");
            
            
                    $lastInsertId_mat = $eec->insererMatieres($nom_mat);
                    $lastInsertId_exe = $eec->insererExercices($titre_exe, $libelle_exe, $fichier, $date_pub, $heure_pub, $lastInsertId_mat);
                    $eec->insererCorrections($titre_cor, $libelle_cor, $fichier, $date_pub, $heure_pub, $lastInsertId_exe);
            
                    $eec->supprimerExcerciceCorrection($id);
                    header("Location: " . HOST . "zoneAdmin.php");  
                            
                } 
                
                if(isset($_POST["supprimer"]))
                {
                    $id = (int) $eec->filtrerDonnees($_POST["id"]);
            
                    $eec->supprimerExcerciceCorrection($id);
                    header("Location: " . HOST . "zoneAdmin.php");          
                }

                
                    
            

            include(VIEW_ROOT."form_modifierExerciceUtilisateur.php");
        } 

/*============================================================================================================================ */    

            public function affichePageform_admin()
            {
                require("connexionBd.php");
                require(MODEL_ROOT."ExercicesEtCorrections.class.php");
                require(MODEL_ROOT."fonctions.php");
                securiteAdminRole('administrateur');

                    if (isset($_POST["envoyer"])) 
                    {
                        $eec = new ExercicesEtCorrections($connexionBd);

                        $nom_mat = $eec->filtrerDonnees($_POST["nom_mat"]);

                        $titre_exe = $eec->filtrerDonnees($_POST["titre_exe"]);
                        $libelle_exe = $eec->filtrerDonnees($_POST["libelle_exe"]);
                        $libelle_cor = $eec->filtrerDonnees($_POST["libelle_cor"]);

                        $date_pub = date("Y-m-d");
                        $heure_pub = date("H-m-s");
                        $nom_fichier_pdf = ""; // initialisation de la $var a vide dans le cas ou le champs reste vide (aucun pdf)


                            if(!(isset($_FILE)) OR (empty($_FILE)))
                            {
                                $lastInsertId_mat = $eec->insererMatieres($nom_mat);
                                $lastInsertId_exe = $eec->insererExercices($titre_exe, $libelle_exe, $nom_fichier_pdf, $date_pub, $heure_pub, $lastInsertId_mat);
                
                                                    $eec->insererCorrections($titre_exe, $libelle_cor, $nom_fichier_pdf, $date_pub, $heure_pub, $lastInsertId_exe);
                                ?>
                                    <script>
                                        alert("Exercice inserer avec succes");
                                    </script>
                                <?php                       
                            }


                                if(isset($_FILE) AND !empty($_FILE))
                                {
                                        $nom_fichier_pdf =  ($_FILES["fichier_pdf"]["name"]);
                                        $emplacement_temp_pdf = ($_FILES["fichier_pdf"]["tmp_name"]);
                                        $emplacement_reel_pdf = __DIR__ . "/docpdf/".$nom_fichier_pdf;
                                        $extension_du_fichier = strrchr($nom_fichier_pdf, ".");
                                        $extension_autoriser = ['.pdf', '.PDF'];    
                                        // echo "extension du fichier est   ".$extension_du_fichier;exit();
                                        
                                        if(in_array($extension_du_fichier, $extension_autoriser))
                                        {
                                            $lastInsertId_mat = $eec->insererMatieres($nom_mat);
                                            $lastInsertId_exe = $eec->insererExercices($titre_exe, $libelle_exe, $nom_fichier_pdf, $date_pub, $heure_pub, $lastInsertId_mat);
                                                                $eec->insererCorrections($titre_exe, $libelle_cor, $nom_fichier_pdf, $date_pub, $heure_pub, $lastInsertId_exe);
                                            
                                            $verifUpload = move_uploaded_file($emplacement_temp_pdf, $emplacement_reel_pdf);
                                            
                                            if($verifUpload)
                                            {
                                                ?>
                                                    <script>
                                                        alert("Exercice et sujet PDF inserer avec succes");
                                                    </script>
                                                <?php
                                            }else
                                            {
                                                ?>
                                                    <script>
                                                        alert("Erreur exercice et sujet PDF non inserer ");
                                                    </script>
                                                <?php
                                            }

                                        }
                                        else
                                        {
                                            ?>
                                                <script>
                                                    alert("ATTENTION : Seul les fichiers PDF sont autoriser ");
                                                </script>
                                            <?php
                                        }
                                }
                                

                    }

                    include(DOC_ADMINISTRATEUR."form_admin.php");
            }
            
        /*============================================================================================================================ */    

        public function affichePageTelechargerPdfCc()
        {
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            
            
            $eec = new ExercicesEtCorrections($connexionBd);
            
            if(isset($_GET["id"]))
            {
                $id_pdf = (int) $_GET["id"]; 
                $filiere =(string) $_GET["filiere"];
                $examen = (string) ("cc");
                // 'SELECT $examen FROM $filiere WHERE id = :id_pdf '    
                $req = $eec->ligneFichierPDF($examen, $filiere, $id_pdf);
                // var_dump($req);
                // die();
                
                
                if(isset($req) && !empty($req->cc))
                {   
                    $emplacementPDF = ASSETS_ROOT."uploads/docpdf/";
                    $nom_fichierPDF = $req->cc;
                    
                    // S'assurer que le fichier a l'extension .pdf
                    if (strtolower(substr($nom_fichierPDF, -4)) !== '.pdf') {
                        $nom_fichierPDF .= '.pdf';
                    }
                    
                    $cheminComplet = $emplacementPDF . $req->cc;
                    
                    if (file_exists($cheminComplet)) {
                        header("Content-Description: File transfer");
                        header("Content-Type: application/pdf");
                        header("Content-Disposition: attachment; filename=\"" . basename($nom_fichierPDF) . "\"");
                        header("Content-Length: " . filesize($cheminComplet));
                        header("Cache-Control: no-cache, must-revalidate");
                        header("Pragma: no-cache");
                        ob_clean();
                        flush();
                        readfile($cheminComplet);
                        exit();
                    }
                }
                
                else
                {
                    ?>  
                    <script>
                        alert("Ce fichier PDF n'existe pas ");
                    </script>  <?php
                }
                
            
            }    
        } 


        /*============================================================================================================================ */

        public function affichePageTelechargerPdfSn()
        {
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            
            $eec = new ExercicesEtCorrections($connexionBd);
            
            if(isset($_GET["id"]))
            {
                $id_pdf = (int) $_GET["id"]; 
                $filiere =(string) $_GET["filiere"];
                $examen = (string) ("sn");
                // 'SELECT $examen FROM $filiere WHERE id = :id_pdf '    
                $req = $eec->ligneFichierPDF($examen, $filiere, $id_pdf);
                // var_dump($req);
                // die();
                
                
                if(isset($req) && !empty($req->sn))
                {   
                    $emplacementPDF = ASSETS_ROOT."uploads/docpdf/";
                    $nom_fichierPDF = $req->sn;
                    
                    // S'assurer que le fichier a l'extension .pdf
                    if (strtolower(substr($nom_fichierPDF, -4)) !== '.pdf') {
                        $nom_fichierPDF .= '.pdf';
                    }
                    
                    $cheminComplet = $emplacementPDF . $req->sn;
                    
                    if (file_exists($cheminComplet)) {
                        header("Content-Description: File transfer");
                        header("Content-Type: application/pdf");
                        header("Content-Disposition: attachment; filename=\"" . basename($nom_fichierPDF) . "\"");
                        header("Content-Length: " . filesize($cheminComplet));
                        header("Cache-Control: no-cache, must-revalidate");
                        header("Pragma: no-cache");
                        ob_clean();
                        flush();
                        readfile($cheminComplet);
                        exit();
                    }
                }
                
                else
                {
                    ?>  
                    <script>
                        alert("Ce fichier PDF n'existe pas ");
                    </script>  <?php
                }
                
            
            }
        }  


/*============================================================================================================================ */


        public function affichePageTelechargerPdfSr()
        {
                
        require("connexionBd.php");
        require(MODEL_ROOT."ExercicesEtCorrections.class.php");

        $eec = new ExercicesEtCorrections($connexionBd);

        if(isset($_GET["id"]))
        {
            $id_pdf = (int) $_GET["id"]; 
            $filiere =(string) $_GET["filiere"];
            $examen = (string) ("sr");
            // 'SELECT $examen FROM $filiere WHERE id = :id_pdf '    
            $req = $eec->ligneFichierPDF($examen, $filiere, $id_pdf);
            // var_dump($req);
            // die();
            
            
            if(isset($req) && !empty($req->sr))
            {   
                $emplacementPDF = ASSETS_ROOT."uploads/docpdf/";
                $nom_fichierPDF = $req->sr;
                
                // S'assurer que le fichier a l'extension .pdf
                if (strtolower(substr($nom_fichierPDF, -4)) !== '.pdf') {
                    $nom_fichierPDF .= '.pdf';
                }
                
                $cheminComplet = $emplacementPDF . $req->sr;
                
                if (file_exists($cheminComplet)) {
                    header("Content-Description: File transfer");
                    header("Content-Type: application/pdf");
                    header("Content-Disposition: attachment; filename=\"" . basename($nom_fichierPDF) . "\"");
                    header("Content-Length: " . filesize($cheminComplet));
                    header("Cache-Control: no-cache, must-revalidate");
                    header("Pragma: no-cache");
                    ob_clean();
                    flush();
                    readfile($cheminComplet);
                    exit();
                }
            }
            
            else
            {
                ?>  
                <script>
                    alert("Ce fichier PDF n'existe pas ");
                </script>  <?php
            }
            

        }


        }  


/*============================================================================================================================ */

        public function affichePageTelechargerPdfBts()
        {
                
        require("connexionBd.php");
        require(MODEL_ROOT."ExercicesEtCorrections.class.php");

        $eec = new ExercicesEtCorrections($connexionBd);

        if(isset($_GET["id"]))
        {
            $id_pdf = (int) $_GET["id"]; 
            $filiere =(string) $_GET["filiere"];
            $examen = (string) ("bts");
            // 'SELECT $examen FROM $filiere WHERE id = :id_pdf '    
            $req = $eec->ligneFichierPDF($examen, $filiere, $id_pdf);
            // var_dump($req);
            // die();
            
            
            if(isset($req) && !empty($req->bts))
            {   
                $emplacementPDF = ASSETS_ROOT."uploads/docpdf/";
                $nom_fichierPDF = $req->bts;
                
                // S'assurer que le fichier a l'extension .pdf
                if (strtolower(substr($nom_fichierPDF, -4)) !== '.pdf') {
                    $nom_fichierPDF .= '.pdf';
                }
                
                $cheminComplet = $emplacementPDF . $req->bts;
                
                if (file_exists($cheminComplet)) {
                    header("Content-Description: File transfer");
                    header("Content-Type: application/pdf");
                    header("Content-Disposition: attachment; filename=\"" . basename($nom_fichierPDF) . "\"");
                    header("Content-Length: " . filesize($cheminComplet));
                    header("Cache-Control: no-cache, must-revalidate");
                    header("Pragma: no-cache");
                    ob_clean();
                    flush();
                    readfile($cheminComplet);
                    exit();
                }
            }
            
            else
            {
                ?>  
                <script>
                    alert("Ce fichier PDF n'existe pas ");
                </script>  <?php
            }
            

        }

        }  

/*============================================================================================================================ */

        public function affichePageTelechargerPdfTd()
        {
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            
            
            $eec = new ExercicesEtCorrections($connexionBd);
            
            if(isset($_GET["id"]))
            {
                $id_pdf = (int) $_GET["id"]; 
                $filiere =(string) $_GET["filiere"];
                $examen = (string) ("td");
                // 'SELECT $examen FROM $filiere WHERE id = :id_pdf '    
                $req = $eec->ligneFichierPDF($examen, $filiere, $id_pdf);
                // var_dump($req);
                // die();
                
                
                if(isset($req) && !empty($req->td))
                {   
                    $emplacementPDF = ASSETS_ROOT."uploads/docpdf/";
                    $nom_fichierPDF = $req->td;
                    
                    // S'assurer que le fichier a l'extension .pdf
                    if (strtolower(substr($nom_fichierPDF, -4)) !== '.pdf') {
                        $nom_fichierPDF .= '.pdf';
                    }
                    
                    $cheminComplet = $emplacementPDF . $req->td;
                    
                    if (file_exists($cheminComplet)) {
                        header("Content-Description: File transfer");
                        header("Content-Type: application/pdf");
                        header("Content-Disposition: attachment; filename=\"" . basename($nom_fichierPDF) . "\"");
                        header("Content-Length: " . filesize($cheminComplet));
                        header("Cache-Control: no-cache, must-revalidate");
                        header("Pragma: no-cache");
                        ob_clean();
                        flush();
                        readfile($cheminComplet);
                        exit();
                    }
                }
                
                else
                {
                    ?>  
                    <script>
                        alert("Ce fichier PDF n'existe pas ");
                    </script>  <?php
                }
                
            
            }
        }    

/*============================================================================================================================ */


        public function affichePageTelechargerPdfTp()
        {
            require("connexionBd.php");
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            
            
            $eec = new ExercicesEtCorrections($connexionBd);
            
            if(isset($_GET["id"]))
            {
                $id_pdf = (int) $_GET["id"];

                $filiere =(string) $_GET["filiere"];
                $examen = (string) ("tp");
                // 'SELECT $examen FROM $filiere WHERE id = :id_pdf '    
                $req = $eec->ligneFichierPDF($examen, $filiere, $id_pdf);
                
                
                if(isset($req) && !empty($req->tp))
                {   
                    $emplacementPDF = ASSETS_ROOT."uploads/docpdf/";
                    $nom_fichierPDF = $req->tp;
                    
                    // S'assurer que le fichier a l'extension .pdf
                    if (strtolower(substr($nom_fichierPDF, -4)) !== '.pdf') {
                        $nom_fichierPDF .= '.pdf';
                    }
                    
                    $cheminComplet = $emplacementPDF . $req->tp;
                    
                    if (file_exists($cheminComplet)) {
                        header("Content-Description: File transfer");
                        header("Content-Type: application/pdf");
                        header("Content-Disposition: attachment; filename=\"" . basename($nom_fichierPDF) . "\"");
                        header("Content-Length: " . filesize($cheminComplet));
                        header("Cache-Control: no-cache, must-revalidate");
                        header("Pragma: no-cache");
                        ob_clean();
                        flush();
                        readfile($cheminComplet);
                        exit();
                    }
                }
                
                else
                {
                    ?>  
                    <script>
                        alert("Ce fichier PDF n'existe pas ");
                    </script>  <?php
                }
                
            
            }
        }


        /*============================================================================================================================ */
        public function affichePageListe_filieres()
        {
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            
            if(isset($_GET["sujet"]) AND !empty($_GET["sujet"]))
            {
                $sujet =(string) $_GET["sujet"];
                
                include_once(CEFODBUSINESSSCHOOL_ROOT."filieres/liste_filieres.php");
            }
        } 
        /*============================================================================================================================ */
        public function affichePageListe_niveaux()
        {
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");
            
            if(isset($_GET["filiere"]) AND !empty($_GET["filiere"]) AND isset($_GET["examen"]) AND !empty($_GET["examen"]))
            {
                $sujet =(string) $_GET["examen"];
                include_once(CEFODBUSINESSSCHOOL_ROOT."niveaux/liste_niveaux.php");
            }
        }  
        /*============================================================================================================================ */
        public function affichePageErreur404()
        {
            require(MODEL_ROOT."ExercicesEtCorrections.class.php");

            include_once(VIEW_ROOT."erreur404.php");
        }

/*============================================================================================================================ */
                
       


/*--------------------------------------------
    SYSTEME DE GESTION DES UTILISATEURS CBS
--------------------------------------------*/
/*============================================================================================================================ */    

public function affichePageCbs()
{ 
    require("connexionBd.php");
    require(MODEL_ROOT."ExercicesEtCorrections.class.php");
    
    // Empêcher la mise en cache
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    
    // Vérifier si l'etudiant est connecté
    if (!isset($_SESSION['etudiant'])) {
        // Rediriger vers la page de connexion
        header("Location: ".HOST."form_connexionCbs");
        exit();
    }

    include_once(CEFODBUSINESSSCHOOL_ROOT."index.php");
}


/*============================================================================================================================ */
public function affichePageForm_inscriptionEtudiantCbs()
{

    require("connexionBd.php");
    require(MODEL_ROOT."ExercicesEtCorrections.class.php");
    $eec = new ExercicesEtCorrections($connexionBd);
    
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["enregistrer"])) 
    {
        $prenom_etu = strtolower(htmlspecialchars($_POST["prenom_etu"]));
        $email_etu = strtolower(htmlspecialchars($_POST["email_etu"]));        
        $carte_recto_etu = $_FILES["carte_recto_etu"];
        $carte_verso_etu = $_FILES["carte_verso_etu"];
    
        // Vérifier si les fichiers ont été uploadés
        if ($carte_recto_etu["error"] === 0 && $carte_verso_etu["error"] === 0) 
        {
            $dossier_upload = ASSETS_UPLOADS_CBS_IMAGES_ROOT; // Dossier où stocker les images
            $nom_recto = uniqid() . "_" . basename($carte_recto_etu["name"]);
            $nom_verso = uniqid() . "_" . basename($carte_verso_etu["name"]);
        
            // Déplacer les fichiers uploadés
            if (move_uploaded_file($carte_recto_etu["tmp_name"], $dossier_upload . $nom_recto) &&
                move_uploaded_file($carte_verso_etu["tmp_name"], $dossier_upload . $nom_verso)) {
                
                // Insérer les données dans la table `etudiant_cbs`
                try 
                {
                    $req = $connexionBd->prepare("
                        INSERT INTO etudiant_cbs_temp (prenom_etu, email_etu, carte_recto_etu, carte_verso_etu)
                        VALUES (:prenom_etu, :email_etu, :carte_recto_etu, :carte_verso_etu)
                    ");
                    $req->bindParam(':prenom_etu', $prenom_etu, PDO::PARAM_STR);
                    $req->bindParam(':email_etu', $email_etu, PDO::PARAM_STR);
                    $req->bindParam(':carte_recto_etu', $nom_recto, PDO::PARAM_STR);
                    $req->bindParam(':carte_verso_etu', $nom_verso, PDO::PARAM_STR);
                    $req->execute();
                    
                    ?>
                    <script>alert("Demande envoyee avec succes, veillez attendre un email de validation de votre compte")</script>
                    <?php

                    // ✅ Message de confirmation personnalisé
                    $_SESSION['message_inscription'] = "✅ Veuillez patienter au plus tard 24h le temps qu'un administrateur valide votre compte et vous envoie un email avec votre identifiant de connexion.";

                    header("Location: ".HOST."form_connexionCbs");
                    exit();
                } 
                catch (PDOException $e) 
                {
                    die("Erreur lors de l'inscription : " . $e->getMessage());
                }
            } else {
                ?>
                <script>alert("Erreur lors de l'importation des fichiers.")</script>
                <?php
                header("Location: ".HOST."form_inscriptionCbs");
                exit();
            }
        } else {
            ?>
            <script>alert("Veuillez télécharger les deux images de la carte d'étudiant.")</script>
            <?php

            header("Location: ".HOST."form_inscriptionCbs");
            exit();
        }
    }


    include(CEFODBUSINESSSCHOOL_ROOT . "form_inscriptionCbs.php");
}

/*============================================================================================================================*/
public function affichePageForm_connexionEtudiantCbs()
{
    require("connexionBd.php");
    require(MODEL_ROOT."ExercicesEtCorrections.class.php");
    $eec = new ExercicesEtCorrections($connexionBd);
    $error = null;
    
    // ✅ Récupération du message (si présent)
    $message_inscription = '';
    if (isset($_SESSION['message_inscription'])) {
        $message_inscription = $_SESSION['message_inscription'];
        unset($_SESSION['message_inscription']); // On le supprime après affichage (message flash)
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["connexion"])) 
    {
        $identifiant_etu = strtolower(htmlspecialchars($_POST["identifiant_etu"]));

        try {

            // Vérifier si l'utilisateur existe et si le compte est confirmé
            $req = $connexionBd->prepare("SELECT * FROM etudiant_cbs WHERE identifiant_etu = :identifiant_etu AND compte_confirme_etu = 1");
            $req->bindParam(':identifiant_etu', $identifiant_etu, PDO::PARAM_STR);
            $req->execute();
            $etudiant = $req->fetch(PDO::FETCH_ASSOC);

            if ($etudiant) 
            {
                // Créer une session utilisateur
                $_SESSION['etudiant'] = [
                    'id_etu' => $etudiant['id_etu'],
                    'prenom_etu' => $etudiant['prenom_etu'],
                    'email_etu' => $etudiant['email_etu'],
                    'identifiant_etu' => $etudiant['identifiant_etu']
                ];
                header("Location: ".HOST."cefodbusinessschool"); 
                exit();
            } else {
                ?>
                    <script>alert("Identifiant incorrect ou compte non confirmé.")</script>
                <?php
                $error = "L'email et le mot de passe sont requis.";
                header("Location: ".HOST."form_connexionCbs");
                exit();
            }
        } catch (PDOException $e) {
            $error = $e->getMessage(); // Capture erreur
        }
    }

    include(CEFODBUSINESSSCHOOL_ROOT . "form_connexionCbs.php");
}

/*============================================================================================================================ */
public function affichePageDeconnexionEtudiantCbs()
{
    require("connexionBd.php");

    session_start();
    session_unset();
    session_destroy();
    header("Location: ".HOST."form_connexionCbs");
    exit();
    
}
/*============================================================================================================================ */  

public function dvrtusbetakefesfsrfrgtgesfdsfdgrw()
{       
    require(MODEL_ROOT."ExercicesEtCorrections.class.php");

    // "achat-liv-valider-671116" =>            ["controller" => "Accueil", "method" => "dvrtusbetakefesfsrfrgtgesfdsfdgrw"],
    //  https://exercicesetcorrectionscbs.com/nom_pdf.pdf

    $nom_livre = (string)"nomlivre.pdf";
 
    if(isset($nom_livre))
    {   
        $emplacementPDF = ASSETS_ROOT."uploads/cbs/docpdf/";
        $nom_fichierPDF = $nom_livre;
        header("Content-Description: File transfer");
        header("Content-type:application/octet-stream");
        header("Content-Disposition:attachment;filename=".$nom_fichierPDF);
        header("Content-length:".filesize($emplacementPDF.$nom_fichierPDF));
        ob_clean();
        readfile($emplacementPDF.$nom_fichierPDF);
    }
    
    else
    {
        ?>  
        <script>
            alert("Ce fichier PDF n'existe pas ");
        </script>  <?php
    }
    

}
/*============================================================================================================================*/









}  
?>