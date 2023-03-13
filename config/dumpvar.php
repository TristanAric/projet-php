<?php

/**
 * Fonction à utiliser de préférence à var_dump() surtout lorsque XDebug n'est pas déployé sur la configuration.
 * 
 * Attention, pour voir les affichages, il faut:
 * 	* soit basculer la constante DUMP à TRUE dans votre application...
 * 	* soit passer TRUE en deuxième paramètre.
 * 
 * Vous pouvez passer en 3ème paramètre une chaîne de caractères pour commenter le dump.
 * Dans ce cas, vous DEVEZ donner une valeur pour le deuxième paramètre (soit DUMP, soit TRUE).
 * @param mixed $var la variable à afficher
 * @param bool $dump soit DUMP pour utiliser la configuration, soit true pour afficher tout le temps (pas en prod!)
 * @param string $msg le message d'en-tête de l'affichage du dump.
 */
function dump_var($var, bool $dump = DUMP, ?string $msg = null) {
    if ($dump) {
        if (!defined('DUMP_MODE'))
            define('DUMP_MODE', 'phaln');
        switch (DUMP_MODE) {
            case 'phaln':
                if ($msg) {
                    echo"<p><strong>$msg</strong></p>";
                }
                echo '<pre>';
                var_dump($var);
                echo '</pre>';
                break;
            case 'dump':
                if ($msg) {
                    echo"<p><strong>$msg</strong></p>";
                }
                dump($var);
                break;
            default:
                var_dump($var);
        }
    }
}
