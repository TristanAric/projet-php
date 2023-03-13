<?php

//  Basculer à TRUE pour activer les affichages de debug, les var_dump ou les dump_var
define('DUMP', true);               //  Affichage des dump et des exceptions si true
define('DUMP_EXCEPTIONS', true);    // Affichage des exceptions si true, même lorsque DUMP est false
define('DUMP_MODE', 'dump');        // Mode d'affichage des dump: 'dump' pour Symfony, 'phaln' pour mode phaln, rien pour var_dump par défaut (la forme dépend de la présence ou non de XDebug)

//  Celui-ci, vous ne devriez pas avoir besoin de l'utiliser.
//  Il permet d'afficher les messages de debug de la librairie Phaln.
define('DEBUG_PHALN', false);

//  L'url de votre site, sera utile dans les redirections dans vos pages en cas de déplacement du site...
//  En localhost, l'url peut être de la forme 'http://localhost/dev/skeleton_light/' si vous n'avez pas défini de virtual-host
define('URL_BASE', 'http://MonDomaine.com/');

//  Le titre à donner aux pages du site
define('TITRE_APP', 'Mon Application');
define('VERSION_APP', '0.0.1');

// La durée d'une session (en secondes)
define('SESSION_LENGTH', 1800);

//  Les informations de connexion à la BDD
$infoBdd = array(
    'interface' => 'pdo', // "pdo" ou "mysqli"
    'type' => 'mysql', //  mysql ou pgsql
    'host' => '', // Votre serveur de bdd
    'port' => 3306, // Par défaut: 5432 pour postgreSQL, 3306 pour MySQL
    'charset' => 'UTF8', // charset de la bdd
    'dbname' => '', // Le nom de la bdd
    'user' => '', // l'utilisateur de la bdd
    'pass' => '', // le password de l'utilisateur de la bdd
);

// Vos infos serveur mail (pour PHPMailer)
$infoMail = [
    'Host' => 'smtp.mondomaine.com', //Adresse IP ou DNS du serveur SMTP
    'Port' => 465, //Port TCP du serveur SMTP
    'SMTPAuth' => true, //Utiliser l'identification
    'SMTPSecure' => 'tls', //Protocole de sécurisation des échanges avec le SMTP
    'UserName' => 'contact@mondomaine.com', //Identifiant serveur SMTP
    'Password' => 'monpassword', // mot de passe smtp
    'FromMail' => 'sender@mondomaine.com', // @ mail sender
    'FromName' => 'M. Sender', // Le nom en clair de l'expéditeur
    'IsHtml' => true, // envoi en HTML
];

//  Inclusion de la configuration globale
require_once 'globalConfig.php';

try {
    //  Vérification de l'existence de la fonction dump_var (normalement dans librairie Phaln...)
    if (!function_exists('dump_var')) {
	// Elle n'existe pas. Y-a-t'il un fichier qui la définie?
	if (file_exists(CONFIG_DIR . 'dumpvar.php')) {
	    if (!defined('DUMP_MODE'))
		define('DUMP_MODE', 'phaln');
	    include_once CONFIG_DIR . 'dumpvar.php';
	} else {
	    // Pas de fichier non plus... elle est redéfinie.
	    function dump_var($var, $a, $m) {
		if (DUMP)
		    var_dump($var);
	    }
	}
    }
    
    //  Réglage du nom de fichier pour logger les exceptions
    if (file_exists(PHALN_DIR . DIRECTORY_SEPARATOR . 'phaln' . DIRECTORY_SEPARATOR . 'Utility' . DIRECTORY_SEPARATOR . 'FileLogger.php') && class_exists('Phaln\Utility\FileLogger')) {
	Phaln\Utility\FileLogger::$defaultFileName = LOG_DIR . TITRE_APP . '.log';
    }
    //  Réglage du nom de l'espace de nom dans lequel se trouve les espaces de nom Entities et Repositories du model de l'application
    if (file_exists(PHALN_DIR . DIRECTORY_SEPARATOR . 'phaln' . DIRECTORY_SEPARATOR . 'Manager.php') && class_exists('Phaln\Manager')) {
	Phaln\Manager::setDefaultModelNameSpace('');
    }


    //  Lancement des sessions, si ce n'est pas déjà fait.
    //  Le faire après l'inclusion de 'globalConfig.php' permet d'avoir l'autoload actif
    //  et de pouvoir désérializer des objets depuis les sessions.
    if (session_status() === PHP_SESSION_NONE) {
	ini_set('session.use_strict_mode', 1);
	session_start();
    }
} catch (Throwable $ex) {
    var_dump($ex);
}