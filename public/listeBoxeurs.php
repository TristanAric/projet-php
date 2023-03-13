<?php

require_once '../config/appConfig.php';

$mapper = new \Repositories\BoxeurRepository();
$boxeurs = $mapper->getAll();

$mapperSecond = new \Repositories\CategoriePoidsRepository();
$categoriesPoids = $mapperSecond->getAll();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des boxeurs</title>
    <?php include_once 'inc/head.php'; ?>
</head>
<body>
    <?php include_once 'inc/header.php'; ?>

    <main>
        <article>
            <header>
                <h1>Liste des boxeurs</h1>
            </header>
            <form action="" method="get">
                <select class="form-control form-control-sm" aria-label="Default select example" name="id_categorie_poids" onchange='this.form.submit()'>
                    <option>Choisir sa catégorie poids</option>
                    <option value="default">Toutes les catégories</option>
                    <?php foreach ($categoriesPoids as $categoriePoids) :?>
                        <option value="<?php echo $categoriePoids->getId();?>"><?php echo $categoriePoids->getRef();?> - <?php echo $categoriePoids->getIntitule();?></option>
                    <?php endforeach;?>
                </select>
                <noscript><input type="submit" value="Submit"></noscript>
            </form>
            <?php 
            $datas['id_categorie_poids'] = ($tmp = filter_input(INPUT_GET, 'id_categorie_poids', FILTER_VALIDATE_INT)) ? $tmp : null;
            $alternative_mapper = new \Repositories\BoxeurRepository();
            ?>

            <section>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">Nom</th>
                            <th scope="col" class="text-center">Prenom</th>
                            <th scope="col" class="text-center">Sexe</th>
                            <th scope="col" class="text-center">Licence</th>
                            <th scope="col" class="text-center">Club</th>
                            <th scope="col" class="text-center">Catégorie poids</th>
                            <th scope="col" class="text-center">Modification</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_null($datas['id_categorie_poids']) || $_GET['id_categorie_poids'] === "default") {
                            foreach ($boxeurs as $boxeur): ?>
                            <tr>
                                <td class="text-center"><?= $boxeur->getId() ?></td>
                                <td class="text-center"><?= $boxeur->getNom() ?></td>
                                <td class="text-center"><?= $boxeur->getPrenom() ?></td>
                                <td class="text-center"><?= $boxeur->getSexe() ?></td>
                                <td class="text-center"><?= $boxeur->getLicence() ?></td>
                                <td class="text-center"><?= $boxeur->getClub()->getNom() ?></td>
                                <td class="text-center"><?= $boxeur->getCategoriePoids()->getIntitule() ?></td>
                                <form method="POST" action="formEditBoxeur.php">
                                    <input type="hidden" name="id_boxeur" value="<?= $boxeur->getId() ?>"/>
                                    <td class="text-center"> 
                                        <button type="submit" class="btn btn-dark"><i class="fa-solid fa-file-pen"></i></button> 
                                    </td>
                                </form>
                            </tr>
                            <?php endforeach; } else {
                            $boxeursPoids = $alternative_mapper->getBoxeursPoids($datas['id_categorie_poids']);
                            
                                if(empty($boxeursPoids)) { ?>
                                    <tr>
                                        <td class="text-center font-weight-bold" style= "font-size: 20px;" colspan="8">Aucune valeur</td>
                                    </tr>
                                <?php } else {
                                    foreach ($boxeursPoids as $boxeurPoids): ?>
                                    <tr>
                                        <td class="text-center"><?= $boxeurPoids->getId() ?></td>
                                        <td class="text-center"><?= $boxeurPoids->getNom() ?></td>
                                        <td class="text-center"><?= $boxeurPoids->getPrenom() ?></td>
                                        <td class="text-center"><?= $boxeurPoids->getSexe() ?></td>
                                        <td class="text-center"><?= $boxeurPoids->getLicence() ?></td>
                                        <td class="text-center"><?= $boxeurPoids->getClub()->getNom() ?></td>
                                        <td class="text-center"><?= $boxeurPoids->getCategoriePoids()->getIntitule() ?></td>
                                        <form method="POST" action="formEditBoxeur.php">
                                            <input type="hidden" name="id_boxeur" value="<?= $boxeurPoids->getId() ?>"/>
                                            <td class="text-center"> 
                                                <button type="submit" class="btn btn-dark"><i class="fa-solid fa-file-pen"></i></button> 
                                            </td>
                                        </form>
                                    </tr>
                            <?php endforeach; } }?>
                    </tbody>
                </table>

                <button class="btn btn-primary btn-block btn-size" type="button" onclick="window.location.href='./formEditBoxeur.php'">Ajouter un boxeur</button>

            </section>
        </article>
    </main>
    <?php include_once 'inc/footer.php'; ?>
</body>
</html>


<style>
    .form-control-sm {
        width: 220px !important;
        margin: 10px 5px!important;

    }
    .btn-size {
        width: 20% !important;
        margin: 0 auto;
    }
</style>