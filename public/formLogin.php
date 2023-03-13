<?php

require_once '../config/appConfig.php';

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
                <h1>Page de connexion</h1>
            </header>
            <section>
            <div class="container-fluid">
                    <div class="row vertical-center">
                        <form class="col-xs-8 col-xs-offset-2  col-sm-6 col-sm-offset-3 col-md-4 col-sm-offset-4 col-lg-2 col-lg-offset-5" method="post" action="./traits/traitLogin.php">
                            <h2>Insérer vos infos</h2>
                            <input type="hidden" name="csrftoken" value="<?= (isset($_SESSION['token'])) ? $_SESSION['token']: '' ?>"/> 
                            <p>
                            <label class="sr-only" for="login">Identifiant de connexion :</label>
                            <input class="form-control" type="text" name="login" placeholder="Insérer votre login" required autofocus maxlength="45" size="30">
                            </p>
                            <p>
                            <label class="sr-only" for="pass">Mot de passe :</label>
                            <input class="form-control" type="password" name="pass" placeholder="Insérer votre mot de passe" required autofocus maxlength="45" size="30">
                            </p>
                            <p>
                            <input class="btn btn-primary btn-block" type="submit" value="Connexion" /> 
                        </form>
                    </div>
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