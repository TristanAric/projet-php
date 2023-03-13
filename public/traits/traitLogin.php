<?php

declare(strict_types=1);
require_once '..\..\config\appConfig.php';

$error = true;
if(!isset($_SESSION['Dirigeant']))
    $_SESSION['Dirigeant'] = [];

if ('POST' === filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS)) {

    $token = ($tmp = filter_input(INPUT_POST, 'csrftoken', FILTER_SANITIZE_SPECIAL_CHARS)) ? $tmp : '';

    if (!empty($_SESSION['token']) && $token !== '' && hash_equals($_SESSION['token'], $token)) {

        unset($_SESSION['token']);
        $error = false;
        $datas['pass'] = ($tmp = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS)) ? substr($tmp, 0, 100) : null;
        $datas['login'] = ($tmp = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS)) ? substr(($tmp), 0, 45) : null;

        $dirigeant = new Entities\Dirigeant($datas);
        $mapVerif = new \Repositories\DirigeantRepository();
        $mapVerif->authentify($dirigeant);
    }
}

if ($error) {

    $url = '../listeBoxeurs.php';
    header("location: $url");
} else {
    
    $url = '../listeBoxeurs.php';
    header("location: $url");
}
