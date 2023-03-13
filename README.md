# Partiel de PHP

Auteur: Philippe Alluin p.alluin@phaln.info

**ATTENTION!!** Il est interdit d'utiliser la librairie Phaln ou d'en copier du code **!!ATTENTION**

## Installation et configuratioon:

- Placez-vous dans `www` (ou `htdocs`) et ouvrez un terminal dans ce dossier.

- Clonez depuis GitLab le projet `Sujet Evaluation PHP` (identification sans doute demandée)
  vers le dossier de votre choix (`PartielPhp` par exemple):

`git clone https://gitlab.com/webtech-n2/sujet-evaluation-php.git PartielPhp`

- Rendez-vous dans le dossier `PartielPhp`:

`cd PartielPhp`

- Installer les dépendances dans le dossier `vendor` à l'aide de
  composer (utilise le fichier `composer.json`):

`composer install`

- Copiez le fichier `appConfig.local.php` puis renommez cette copie en `appConfig.php`.
  **Attention**, le fichier `appConfig.php` n'est pas poussé vers un dépôt Git,
  alors que `appConfig.local.php` l'est.

- Editez le fichier `appConfig.php` pour réglez les paramètres: - Au minimum la définition de `URL_BASE`, qui est l'url d'accès à votre
  application, par exemple `http://localhost/PartielPhp/` si vous avez suivi la procédure précédente. - `$infoBdd` pour connexion à la bdd si vous en utilisez une.
  **ATTENTION!!** le fichier `appConfig.php` est à inclure en début de toutes vos
  pages. **!!ATTENTION**

## Les dossiers principaux:

Le dossier `/public` contient les pages publiques de l'application et les assets,
le fichier `/public/index.php` est la page principale de l'application.

Le dossier `/src` est la dossier de base pour vos développements PHP.

Le dossier `/doc` contient le sujet et les fichiers sql pour la Bdd
