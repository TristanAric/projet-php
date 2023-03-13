<?php

require_once '../config/appConfig.php';
$mapForm = new \Repositories\ClubRepository();
$clubs = $mapForm->getAll();

$mapFormSecond = new \Repositories\CategoriePoidsRepository();
$categoriesPoids = $mapFormSecond->getAll();

$_SESSION['token'] = bin2hex(random_bytes(32));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajouter un boxeur</title>
    <?php include_once 'inc/head.php'; ?>
</head>
<body>
    <?php include_once 'inc/header.php'; ?>

    <main>
        <article>
            <header>
                <h1>Ajouter un boxeur</h1>
            </header>
            <section>
                <div class="container-fluid">
                    <?php if($_SESSION['login'] === false) { ?>
                        <h2 class="text-center font-weight-bold" >Veuillez vous connecter !</h2>
                        <button class="btn btn-primary btn-block btn-connect" onclick="window.location.href='./formLogin.php'"> Connexion </button>
                    <?php } else { ?>
                    <div class="row vertical-center">
                    <?php 
                    $datas['id_boxeur'] = ($tmp = filter_input(INPUT_POST, 'id_boxeur', FILTER_VALIDATE_INT)) ? $tmp : null;
                    if(!is_null($datas['id_boxeur'])) {
                        $mapFormThird = new \Repositories\BoxeurRepository();
                        $boxeur = $mapFormThird->getById($_POST['id_boxeur']);?>
                        <form class="col-xs-8 col-xs-offset-2  col-sm-6 col-sm-offset-3 col-md-4 col-sm-offset-4 col-lg-2 col-lg-offset-5" method="post" action="./traits/traitEditBoxeur.php">
                            <h2>Modifier boxeur :</h2>
                            <input type="hidden" name="csrftoken" value="<?= (isset($_SESSION['token'])) ? $_SESSION['token']: '' ?>"/> 
                            <input type="hidden" name="id_boxeur" value="<?= $boxeur->getId() ?>" />
                            <p>
                            <label class="sr-only" for="nom">Nom du boxeur</label>
                            <input class="form-control" type="text" name="nom" placeholder="Insérer le nom du boxeur" required autofocus maxlength="45" size="30" value="<?= $boxeur->getNom() ?>">
                            </p>
                            <p>
                            <label class="sr-only" for="prenom">Nom du boxeur</label>
                            <input class="form-control" type="text" name="prenom" placeholder="Insérer le prénom du boxeur" required autofocus maxlength="45" size="30" value="<?= $boxeur->getPrenom() ?>">
                            </p>
                            <p>
                            <label class="sr-only" for="sexe">Sexe du boxeur : </label>
                            <?php if($boxeur->getSexe() === "M") {?>
                            <select class="form-control form-control-sm" aria-label="Choisir le sexe du boxeur" name="sexe" required autofocus>
                                <option>Choisir un sexe</option>
                                <option value="M" selected>Homme</option>
                                <option value="F">Femme</option>
                            </select>
                            <?php } else {?>
                            <select class="form-control form-control-sm" aria-label="Choisir le sexe du boxeur" name="sexe" required autofocus>
                                <option>Choisir un sexe</option>
                                <option value="M">Homme</option>
                                <option value="F" selected>Femme</option>
                            </select>
                            <?php } ?>
                            </p>
                            <p>
                            <label class="sr-only" for="Prenom">Numéro de licence du boxeur</label>
                            <input class="form-control" type="number" name="num_licence" placeholder="Insérer le numéro de licence" required autofocus maxlength="11" size="30" min=0 value="<?= $boxeur->getLicence() ?>">
                            </p>
                            <p>
                            <label class="sr-only" for="idClub">Nom du club</label>
                            <select class="form-control form-control-sm" aria-label="Default select example" name="id_club">
                                <option selected>Choisir un club</option>
                                <?php foreach ($clubs as $club) :
                                    if($club->getID() == $boxeur->getClub()->getId()){
                                        $selected = "selected";
                                      }else{
                                        $selected = "";
                                      }?>
                                    <option value="<?php echo $club->getId();?>" <?php echo $selected ?>><?php echo $club->getNom();?></option>
                                <?php endforeach;?>
                            </select>
                            </p>
                            <p>
                            <label class="sr-only" for="id_categorie_poids">Catégorie poids</label>
                            <select class="form-control form-control-sm" aria-label="Default select example" name="id_categorie_poids">
                                <option selected>Choisir sa catégorie poids</option>
                                <?php foreach ($categoriesPoids as $categoriePoids) :
                                    if($categoriePoids->getID() == $boxeur->getCategoriePoids()->getId()){
                                        $selected = "selected";
                                      }else{
                                        $selected = "";
                                      }?>?>
                                    <option value="<?php echo $categoriePoids->getId();?>" <?php echo $selected ?>><?php echo $categoriePoids->getRef();?> - <?php echo $categoriePoids->getIntitule();?></option>
                                <?php endforeach;?>
                            </select>
                            </p>
                            <input class="btn btn-primary btn-block" type="submit" value="Enregistrer" /> 
                        </form>
                    <?php } else {?>
                        <form class="col-xs-8 col-xs-offset-2  col-sm-6 col-sm-offset-3 col-md-4 col-sm-offset-4 col-lg-2 col-lg-offset-5" method="post" action="./traits/traitEditBoxeur.php">
                            <h2>Ajouter boxeur :</h2>
                            <input type="hidden" name="csrftoken" value="<?= (isset($_SESSION['token'])) ? $_SESSION['token']: '' ?>"/> 
                            <p>
                            <label class="sr-only" for="prenom">Prenom du boxeur</label>
                            <input class="form-control" type="text" name="prenom" placeholder="Insérer le prénom du boxeur" required autofocus maxlength="45" size="30">
                            </p>
                            <p>
                            <label class="sr-only" for="nom">Nom du boxeur</label>
                            <input class="form-control" type="text" name="nom" placeholder="Insérer le nom du boxeur" required autofocus maxlength="45" size="30">
                            </p>
                            <p>
                            <label class="sr-only" for="sexe">Sexe du boxeur : </label>
                            <select class="form-control form-control-sm" aria-label="Choisir le sexe du boxeur" name="sexe" required autofocus>
                                <option selected>Choisir un sexe</option>
                                <option value="M">Homme</option>
                                <option value="F">Femme</option>
                            </select>
                            </p>
                            <p>
                            <label class="sr-only" for="Prenom">Numéro de licence du boxeur</label>
                            <input class="form-control" type="number" name="num_licence" placeholder="Insérer le numéro de licence" required autofocus maxlength="11" size="30" min=0>
                            </p>
                            <p>
                            <label class="sr-only" for="idClub">Nom du club</label>
                            <select class="form-control form-control-sm" aria-label="Default select example" name="id_club">
                                <option selected>Choisir un club</option>
                                <?php foreach ($clubs as $club) :?>
                                    <option value="<?php echo $club->getId();?>"><?php echo $club->getNom();?></option>
                                <?php endforeach;?>
                            </select>
                            </p>
                            <p>
                            <label class="sr-only" for="id_categorie_poids">Catégorie poids</label>
                            <select class="form-control form-control-sm" aria-label="Default select example" name="id_categorie_poids">
                                <option selected>Choisir sa catégorie poids</option>
                                <?php foreach ($categoriesPoids as $categoriePoids) :?>
                                    <option value="<?php echo $categoriePoids->getId();?>"><?php echo $categoriePoids->getRef();?> - <?php echo $categoriePoids->getIntitule();?></option>
                                <?php endforeach;?>
                            </select>
                            </p>
                            <input class="btn btn-primary btn-block" type="submit" value="Enregistrer" /> 
                        </form>
                    <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </section>
        </article>
    </main>
    <?php include_once 'inc/footer.php'; ?>
</body>
</html>


<style>
    .vertical-center {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-connect {
        margin : 40px auto 0;
        width: 300px !important;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
    -moz-appearance: textfield;
    }

    .form-select-lg {
        width: 80px;
        margin-left: 50px;
    }

    .form-select {
        width: 320px !important;
    }
</style>