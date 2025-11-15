<?php

class Soutenances
{
    private $connexion_bd;

    // Le constructeur de la classe, prenant en paramètre la connexion à la base de données
    public function __construct($connexion_bd)
    {
        $this->connexion_bd = $connexion_bd;
    }

    //methode pour inserer une filiere dans la table filiere
    public function insererFiliere($filiere)
    {
        $req_inserer = $this->connexion_bd->prepare(" INSERT INTO filiere (libelle) VALUES(:filiere) ");
        $req_inserer->bindParam(':fililere', $filiere, PDO::PARAM_STR);
        $req_inserer->execute();
        return $this->connexion_bd->lasteInsertId(); // renvoi l'ID de la derniere insertion sur cette table qui nous servira plus tard comme valeur de cle etrangere dans une autre table
    }



    // Méthode pour insérer une soutenance dans la table 'soutenance'
    public function insererSoutenance($theme, $resumer, $date_sou, $note, $decision_jury, $version_doc, $id_jur)
    {
        $req_inserer = $this->connexion_bd->prepare("INSERT INTO soutenance (theme, resumer, date_sou, note, decision_jury, version_doc, id_jur) VALUES (:theme, :resumer, :date_sou, :note, :decision_jury, :version_doc, :id_jur)");
        $req_inserer->bindParam(':theme', $theme, PDO::PARAM_STR);
        $req_inserer->bindParam(':resumer', $resumer, PDO::PARAM_STR);
        $req_inserer->bindParam(':date_sou', $date_sou, PDO::PARAM_INT);
        $req_inserer->bindParam(':note', $note, PDO::PARAM_FLOAT);
        $req_inserer->bindParam(':decision_jury', $decision_jury, PDO::PARAM_INT);
        $req_inserer->bindParam(':version_doc', $version_doc, PDO::PARAM_STR);
        $req_inserer->bindParam(':id_jur', $id_jur, PDO::PARAM_INT);
        $req_inserer->execute();
        
    }

    // Méthode pour insérer un etudiant dans la table 'etudiant'
    public function insererEtudiant($nom, $prenom, $matricule, $date_naissance, $lieu_naissance, $id_fil, $id_pro, $id_cyc, $id_sou)
    {
        $req_inserer = $this->connexion_bd->prepare("INSERT INTO etudiant (nom, prenom, matricule, date_naissance, lieu_naissance, id_fil, id_pro, id_cyc, id_sou) VALUES (:nom, :prenom, :matricule, :date_naissance, :lieu_naissance, :id_fil, :id_pro, :id_cyc, :id_sou)");
        $req_inserer->bindParam(':nom', $nom, PDO::PARAM_STR);
        $req_inserer->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $req_inserer->bindParam(':matricule', $matricule, PDO::PARAM_STR);
        $req_inserer->bindParam(':date_naissance', $date_naissance, PDO::PARAM_INT);
        $req_inserer->bindParam(':lieu_naissance', $lieu_naissance, PDO::PARAM_STR);
        $req_inserer->bindParam(':id_fil', $id_fil, PDO::PARAM_INT);
        $req_inserer->bindParam(':id_pro', $id_pro, PDO::PARAM_INT);
        $req_inserer->bindParam(':id_cyc', $id_cyc, PDO::PARAM_INT);
        $req_inserer->bindParam(':id_sou', $id_sou, PDO::PARAM_INT);
        $req_inserer->execute();
    }

    // Méthode pour afficher les données de la table 'soutenance'
    public function afficheSoutenance()
    {
        $req_afficher = $this->connexion_bd->query("SELECT * FROM soutenance ORDER BY id_sou DESC");
        $donnees = $req_afficher->fetchAll(PDO::FETCH_OBJ);
        return $donnees;
    }
        // Méthode pour afficher les données de la table 'promotion'
        public function affichePromotion()
        {
            $req_affiche = $this->connexion_bd->query("SELECT * FROM promotion ORDER BY id_pro DESC");
            $donnees = $req_affiche->fetchAll(PDO::FETCH_OBJ);
            return $donnees;
        }
          
                  

    // Méthode pour supprimer une soutenance de la table 'theme' (attention à la cohérence avec le nom de la table)
    public function supprimerSoutenance($id)
    {
        $req_supprimer = $this->connexion_bd->prepare("DELETE FROM soutenance WHERE id = ?");
        $req_supprimer->execute(array($id));
    }
}

// Exemple d'utilisation
// $connexion_bd = new PDO("mysql:host=localhost;dbname=nom_de_la_base", "utilisateur", "mot_de_passe");
// $gestionSoutenances = new Soutenances($connexion_bd);

?>

