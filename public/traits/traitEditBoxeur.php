<?php

declare(strict_types=1);
require_once '..\..\config\appConfig.php';

$error = true;
if(!isset($_SESSION['Boxeurs']))
    $_SESSION['Boxeurs'] = [];

if ('POST' === filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS)) {

    $token = ($tmp = filter_input(INPUT_POST, 'csrftoken', FILTER_SANITIZE_SPECIAL_CHARS)) ? $tmp : '';

    if (!empty($_SESSION['token']) && $token !== '' && hash_equals($_SESSION['token'], $token)) {

        unset($_SESSION['token']);
        $error = false;
        $datas['id_boxeur'] = ($tmp = filter_input(INPUT_POST, 'id_boxeur', FILTER_VALIDATE_INT)) ? $tmp : null;
        $datas['nom'] = ($tmp = strtoupper(filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS))) ? substr(strtoupper($tmp), 0, 45) : null;
        $datas['prenom'] = ($tmp = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_SPECIAL_CHARS)) ? substr($tmp, 0, 45) : null;
        $datas['sexe'] = ($tmp = strtoupper(filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_SPECIAL_CHARS))) ? substr(strtoupper($tmp), 0, 1) : null;
        $datas['num_licence'] = ($tmp = filter_input(INPUT_POST, 'num_licence', FILTER_VALIDATE_INT)) ? $tmp : null;
        $datas['id_club'] = ($tmp = filter_input(INPUT_POST, 'id_club', FILTER_VALIDATE_INT))? $tmp : null;
        $datas['id_categorie_poids'] = ($tmp = filter_input(INPUT_POST, 'id_categorie_poids', FILTER_VALIDATE_INT))? $tmp : null;

        $boxeur = new Entities\Boxeur($datas);   
        $mapVerif = new \Repositories\BoxeurRepository();
        $mapVerif->save($boxeur);
    }
}

if ($error) {

    $url = '../error.php';
    header("location: $url");
} else {
    
    $url = '../listeBoxeurs.php';
    header("location: $url");
}
