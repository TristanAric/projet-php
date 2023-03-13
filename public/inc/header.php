<?php

require_once '../config/appConfig.php';
require_once '../src/Repositories/DirigeantRepository.php';


if (is_null($_SESSION['login'])) {
    $_SESSION['login'] = false;
}
?>

<header>
    <h1><img src="img/logoPhaln.png" style="max-width: 150px;" alt="Logo">&nbsp;3CSI-2023: Partiel PHP</h1>
    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" onclick="window.location.href='./listeBoxeurs.php'">Liste boxeurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" onclick="window.location.href='./formEditBoxeur.php'">Ajouter boxeur</a>
            </li>
            <?php if($_SESSION['login'] === false) { ?>
                <li class="nav-item second">
                    <a class="nav-link" onclick="window.location.href='./formLogin.php'">Connexion</a>
                </li>
            <?php } else { ?>
                <li class="nav-item second">
                    <span>Bienvenue, <?php echo $_SESSION['prenom_user']." ". $_SESSION['nom_user'] ?></span>
                    <a class="nav-link" onclick="window.location.href='./logout.php'">Déconnexion</a>
                </li>
            <?php } ?>
            </ul>
        </div>
    </nav>
</header>

<style>
    .nav-link {
        cursor: pointer;
    }
    .second {
        display: flex;
        align-items: center;
        position: absolute;
        right: 20px;
    }
</style>