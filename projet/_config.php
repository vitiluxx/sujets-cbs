<?php
/*** CONFIGURATION */
ini_set('display_errors','off');
error_reporting(E_ALL);

$host = $_SERVER['HTTP_HOST'];
$root = $_SERVER['DOCUMENT_ROOT'];

define ('HOST', 'http://'.$host.'/sujets-cbs/projet/');
define ('ROOT', $root.'/sujets-cbs/projet/');

define('MODEL_HOST', HOST.'model/');
define('MODEL_ROOT', ROOT.'model/');

define('VIEW_HOST', HOST.'view/');
define('VIEW_ROOT', ROOT.'view/');

define('CONTROLLER_HOST', HOST.'controller/');
define('CONTROLLER_ROOT', ROOT.'controller/');

define('ASSETS_HOST', HOST.'assets/');
define('ASSETS_ROOT', ROOT.'assets/');
define('ASSETS_UPLOADS_CBS_IMAGES_HOST', ASSETS_HOST.'uploads/cbs/images/');
define('ASSETS_UPLOADS_CBS_IMAGES_ROOT', ASSETS_ROOT.'uploads/cbs/images/');

define('DOC_ADMINISTRATEUR', VIEW_ROOT .'docAdministrateur/');

define('CEFODBUSINESSSCHOOL_HOST', VIEW_HOST.'cefodbusinessschool/');
define('CEFODBUSINESSSCHOOL_ROOT', VIEW_ROOT.'cefodbusinessschool/');

// IDENTIFIANTS POUR L'ENVOIE DES MAIL AUX ETUDIANTS CBS AVEC LEUR IDENTIFIANT DE CONNEXION A L'APP WEB SUJETS CBS
define('SMTP_USERNAME', 'gdc6.td@gmail.com');
define('SMTP_PASSWORD', 'Python66');
?>
