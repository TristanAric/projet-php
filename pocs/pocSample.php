<?php

//  Les deux lignes suivantes sont à inclure dans toutes vos pages "exécutables": 
//  les pages, formulaires, traitements de formulaires, pocs, tests unitaire, ...
//  ATTENTION: pas dans les classes ou les fichier inclus...
declare(strict_types=1);
require_once '../config/appConfig.php';

// Pensez aux use nécessaires

//  Utilisez un bloc try pour intercepter les erreurs et exceptions
try {
    $res = "Resultat";
    dump_var($res, true, 'Variable $res d\'exemple');
    
} catch (Throwable $ex) {
    //  Une erreur ou une exception a été lancée et non traitée...
    dump_var($ex, true, "Throwable!!<br/>".$ex->getMessage());
}