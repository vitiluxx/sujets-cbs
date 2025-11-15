<?php
// Constantes
define('COOKIE_NAME', 'connexion_auto');
define('COOKIE_DURATION', time() + 60 * 60 * 24 * 7); // 1 semaine

// Fonction pour démarrer la session si elle n'est pas déjà démarrée
function startSessionIfNotStarted() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

// Fonction pour générer des jetons sécurisés
function generateToken($length) {
    return bin2hex(random_bytes($length / 2));
}

// Fonction de débogage
function debug($variable, $exit = true) {
    echo '<pre>' . print_r($variable, true) . '</pre>';
    if ($exit) {
        exit();
    }
}

// Fonctions de sécurité
function securite() {
    startSessionIfNotStarted();
    
    // Empêcher la mise en cache des pages protégées
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    
    if (!isset($_SESSION['auth'])) {
        header('location: '.HOST.'form_connexionUtilisateur.php');
        exit();
    }
}

function securiteCbs() {
    startSessionIfNotStarted();
    
    // Empêcher la mise en cache des pages protégées
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    
    if (!isset($_SESSION['usercbs'])) {
        header('location: '.HOST.'form_connexionUtilisateur.php');
        exit();
    }
}

function securiteAdmin() {
    startSessionIfNotStarted();
    
    // Empêcher la mise en cache des pages protégées
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    
    if (!isset($_SESSION['admin'])) {
        header('location: '.HOST.'form_connexionUtilisateur.php');
        exit();
    }
}

function securiteAdminRole($role) {
    startSessionIfNotStarted();
    
    // Empêcher la mise en cache des pages protégées
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    
    if (!isset($_SESSION['admin']) || $_SESSION['admin']['role_adm'] !== $role) {
        header('location: '.HOST.'form_connexionUtilisateur.php');
        exit();
    }
}

// Fonction de reconnexion automatique
function reconnect_auto() {
    startSessionIfNotStarted();
    if (isset($_COOKIE[COOKIE_NAME]) && !isset($_SESSION['auth'])) {
        global $connexionBd;

        $connexion_auto = $_COOKIE[COOKIE_NAME];
        $parts = explode("::", $connexion_auto);
        if (count($parts) !== 2) {
            setcookie(COOKIE_NAME, "", -1);
            return;
        }

        $userId = $parts[0];
        $token = $parts[1];

        $req = $connexionBd->prepare("SELECT * FROM utilisateurs WHERE id_uti = ?");
        $req->execute([$userId]);
        $user = $req->fetch();

        if ($user && password_verify($user['id_uti'] . "Koumadoum", $token)) {
            $_SESSION['auth'] = $user;
            setcookie(COOKIE_NAME, $connexion_auto, COOKIE_DURATION);
            header("Location: form_publierEEC.php");
            exit();
        } else {
            setcookie(COOKIE_NAME, "", -1);
        }
    }
}

// Fonction pour vérifier le rôle de l'administrateur
function isAdminRole($role) {
    startSessionIfNotStarted();
    return isset($_SESSION['admin']) && $_SESSION['admin']['role_adm'] === $role;
}