<?php
    session_start();
    require("_config.php");
    require(ASSETS."connexionBd.php");
    

    
    $userId = $_GET['id'];
    $token = $_GET['token'];

    try {
        $query = "SELECT * FROM utilisateurs WHERE id_uti = ?";
        $req = $connexionBd->prepare($query);
        $req->execute([$userId]);
        $user = $req->fetch();
        // var_dump($user);
        // die();

        if ($user && $token == $user['confirmation_mdp_uti'] ) {
            // die('ok');
            
            $query = "UPDATE utilisateurs SET confirmation_mdp_uti = NULL, confirmation_compte_uti = NOW() WHERE id_uti = ?";
            $req = $connexionBd->prepare($query);
            $req->execute([$userId]);
            $_SESSION['flash']['success'] = "Votre compte a bien été validé";
            $_SESSION['auth'] = $user;
            // var_dump($query);
            // die();

            header("Location: " . HOST . "form_connexionUtilisateur.php");
        } else {

            // die('pas ok');
            $_SESSION['flash']['danger'] = "Ce compte n'existe pas";
            header("Location: " . HOST . "form_inscriptionUtilisateur.php");
        }
    } catch (PDOException $e) {
        // Gérer les erreurs de base de données ici
        echo "Erreur de base de données : " . $e->getMessage();
    }
