<?php

namespace Repositories;

use \PDO;
use Entities\Boxeur;


class BoxeurRepository {

    private ?PDO $db = null;
    private ?string $tableName = null;

    public function __construct() {
        
        global $infoBdd;

        //  Composition du DSN
        $dsn = "{$infoBdd['type']}:dbname={$infoBdd['dbname']};host={$infoBdd['host']};port={$infoBdd['port']};charset={$infoBdd['charset']}";
        $this->db = new PDO($dsn, $infoBdd['user'], $infoBdd['pass']);
        if ($this->db) {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        $this->tableName = 'Boxeur';
    }

    // Fonction getAll pour la page listeBoxeurs.php
    public function getAll(): ?array {

        $resultSet = null;
        $query = "SELECT * FROM {$this->tableName} ORDER BY nom;";
        $reqPrep = $this->db->prepare($query);
        $rqtResult = $reqPrep->execute();

        if ($rqtResult) {
            $reqPrep->setFetchMode(PDO::FETCH_CLASS, Boxeur::class);
            $resultSet = $reqPrep->fetchAll();
        }

        return $resultSet;
    }

    // Fonction getById pour sélectionner tous les informations relatives à un id afin de modifier un boxeur (via formEditBoxeur.php)
    public function getById(int $id_boxeur): ?Boxeur {

        $resultSet = null;
        $query = "SELECT * FROM {$this->tableName} WHERE id_boxeur=:id_boxeur;";
        $reqPrep = $this->db->prepare($query);
        $rqtResult = $reqPrep->execute([':id_boxeur' => $id_boxeur]);

        if ($rqtResult !== false) {

            $reqPrep->setFetchMode(PDO::FETCH_CLASS, Boxeur::class);
            $tmp = $reqPrep->fetch();

            if ($tmp !== false)
                $resultSet = $tmp;
        }

        return $resultSet;
    }

    // Fonction exist pour la page formEditBoxeur.php (vérifie si l'id existe pour pouvoir modifier un boxeur existant)
    public function exist(Boxeur $boxeur): bool {

        $res = (!is_null($this->getById($boxeur->getId()))) ? true : false;
        return $res;
    }

    // Fonction save pour ajouter (queryInsert) ou modifier (queryUpdate) un boxeur existant
    public function save(Boxeur $boxeur): ?Boxeur {

        $res = null;

        $queryInsert = "INSERT INTO {$this->tableName} (nom, prenom, sexe, num_licence, id_club, id_categorie_poids)"
                . " VALUES (:nom, :prenom, :sexe, :licence, :id_club, :id_categorie_poids)";
        $queryUpdate = "UPDATE {$this->tableName} SET"
                . " nom = :nom,"
                . " prenom = :prenom,"
                . " sexe = :sexe,"
                . " num_licence = :licence,"
                . " id_club = :id_club,"
                . " id_categorie_poids = :id_categorie_poids"
                . " WHERE {$this->tableName}.id_boxeur = :id_boxeur ";

        if (is_null($boxeur->getId())) {

            $reqPrep = $this->db->prepare($queryInsert);
            $exec = $reqPrep->execute([':nom' => $boxeur->getNom(),
                ':prenom' => $boxeur->getPrenom(),
                ':sexe' => $boxeur->getSexe(),
                ':licence' => $boxeur->getLicence(),
                ':id_club' => $boxeur->getIdClub(),
                ':id_categorie_poids' => $boxeur->getIdCategoriePoids()]);

            if ($exec !== false) {

                $boxeur->setId(($this->db->lastInsertId()));
                $res = $boxeur;
            }

        } else {

            if ($this->exist($boxeur)) {

                $reqPrep = $this->db->prepare($queryUpdate);
                $exec = $reqPrep->execute([':nom' => $boxeur->getNom(),
                ':prenom' => $boxeur->getPrenom(),
                ':sexe' => $boxeur->getSexe(),
                ':licence' => $boxeur->getLicence(),
                ':id_club' => $boxeur->getIdClub(),
                ':id_categorie_poids' => $boxeur->getIdCategoriePoids(),
                ':id_boxeur' => $boxeur->getId()]);

                if ($exec !== false && $exec > 0) {
                    $res = $boxeur;
                }
            }
        }
        return $res;
    }

    // Fonction getBoxeursPoids pour la page listeBoxeurs.php (affichage en fonction de la catégorie)
    public function getBoxeursPoids(int $id_categorie_poids): ?array {

        $resultSet = null;
        $query = "SELECT * FROM {$this->tableName} WHERE id_categorie_poids = :id_categorie_poids";
        $reqPrep = $this->db->prepare($query);
        $rqtResult = $reqPrep->execute([':id_categorie_poids' => $id_categorie_poids]);

        if ($rqtResult !== false) {
            $reqPrep->setFetchMode(PDO::FETCH_CLASS, Boxeur::class);
            $tmp = $reqPrep->fetchAll();

            if ($tmp !== false)
                $resultSet = $tmp;
        }

        return $resultSet;
    }


}