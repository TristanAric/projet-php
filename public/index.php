<?php
/**
 * ATTENTION!! 
 * Les deux lignes PHP suivantes doivent être incluses dans toutes vos pages "exécutable"
 */

//  Permet d'utiliser le typage fort si strict_types=1
//  ATTENTION!! Laisser en première ligne de toutes vos pages
declare(strict_types=1);

require_once '../config/appConfig.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Partiel PHP</title>
	<?php include_once 'inc/head.php'; ?>
    </head>
    <body>
	<?php include_once 'inc/header.php'; ?>

        <main>
	    <article>
		<header>
		    <h1>Welcome!</h1>
		</header>
		<p>Page d'accueil du partiel PHP promo 2023.</p>
	    </article>
	    <article>
		<header>
		    <h1>Préparation en correction automatique</h1>
		</header>
                <p>Pour l'exercice de préparation en correction automatique, allez à <a href='../pocs/preparation.php'>Préparation</a></p>
	    </article>
	    <article>
		<header>
		    <h1>Liste des boxeurs</h1>
		</header>
                <p>Une page est disponible pour modifications :<a href='./listeBoxeurs.php'>Liste des boxeurs</a></p>
	    </article>
	    <article>
		<header>
		    <h1>Edition des boxeurs</h1>
		</header>
                <p>Une page est disponible pour modifications :<a href='./formEditBoxeur.php'>Edition des boxeurs</a></p>
	    </article>
        </main>

	<?php include_once 'inc/footer.php'; ?>
    </body>
</html>

