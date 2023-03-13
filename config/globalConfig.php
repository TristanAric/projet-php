<?php

// Définition des chemins:
define('BASE_DIR', dirname(__FILE__, 2)); // Le dossier de l'application
define('CONFIG_DIR', BASE_DIR . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR);  //  Pour les fichiers de configuration
define('PUBLIC_DIR', BASE_DIR . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);  //  Pour les fichiers publics
define('SRC_DIR', BASE_DIR . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR);  //  Pour vos classes
define('VENDOR_DIR', BASE_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR);    //  Pour /vendor
define('PHALN_DIR', VENDOR_DIR . 'phaln' . DIRECTORY_SEPARATOR); //  Pour la librairie Phaln
define('NODE_MODULES', BASE_DIR . DIRECTORY_SEPARATOR . 'node_modules' . DIRECTORY_SEPARATOR); // Pour les modules installés avec NPM
define('TEMPLATE_PATH', SRC_DIR . 'Templates' . DIRECTORY_SEPARATOR); //  Pour les templates
define('LOG_DIR', BASE_DIR . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR);   //  Pour les log

// Définitions des constantes pour l'affichage des affichages de débug et des exceptions
if (!defined('DUMP')) {
    define('DUMP', false);
}
if (!defined('DUMP_EXCEPTIONS')) {
    define('DUMP_EXCEPTIONS', false);
}

//  Active ou pas l'affichage de debug et les dump_var
if (DUMP || DUMP_EXCEPTIONS) {//  Affiche les dumps et les throwables
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
} else { //  Affiche rien --> fichiers de log
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', LOG_DIR . 'error_log.txt');
}


////  Définition du path d'inclusion en cas d'utilisation de l'autoload "perso" ci-dessous
//define('CLASS_DIR', SRC_DIR . PATH_SEPARATOR . PHALN_DIR);
//set_include_path(get_include_path() . PATH_SEPARATOR . CLASS_DIR);
//  Autoload pour compatibilité Linux (pb des séparateurs d'espace de nom...)
//  Ne pas utiliser avec la librairie Phaln qui utilise l'autoload de composer (voir en dessous)
//spl_autoload_register(function ($className) {
//    $extension = '.php';
//    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
//    require_once($className . $extension);
//});

//  Si vous aveza installé des modules avec composer, il faut utiliser l'autoload qui est dans vendor.
//  
//  Du coup, vous pouvez profiter de cet autoload. 
//  Pour cela, ajoutez au fichier /composer.json les lignes suivantes qui signaleront /src comme racine de vos classes et espaces de nom.
//    "autoload": {
//	"psr-4": {
//	    "": "src/"
//	}
if (file_exists(VENDOR_DIR . 'autoload.php')) {
    require_once(VENDOR_DIR . 'autoload.php');
}


//  Si la librairie Phaln est utilisée, il faut la configurer avec 
//  les informations de connexion à la base de données.
//  Ces informations se trouve dans le fichier /config/appConfig.php
if (file_exists(PHALN_DIR . DIRECTORY_SEPARATOR . 'phaln' . DIRECTORY_SEPARATOR . 'BDD.php') && class_exists('Phaln\BDD') && isset($infoBdd)) {
    Phaln\BDD::$infoBdd = $infoBdd;
}

//  Utilise le fichier de configuration de la librairie PhAln
//  Ce fichier contient aussi la définition de la fonction dump_var() assez utile...
$phalnConfigFile = PHALN_DIR . DIRECTORY_SEPARATOR . 'phaln' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'phalnConfig.php';
if (file_exists($phalnConfigFile)) {
    require_once($phalnConfigFile);
}