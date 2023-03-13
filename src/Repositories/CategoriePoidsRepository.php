<?php
namespace Repositories;

use \PDO;
use Entities\CategoriePoids;

class CategoriePoidsRepository {

    private ?PDO $db = null;
    private ?string $tableName = null;

    public function __construct() {

        global $infoBdd; 
        $dsn = "{$infoBdd['type']}:dbname={$infoBdd['dbname']};host={$infoBdd['host']};port={$infoBdd['port']};charset={$infoBdd['charset']}";
        $this->db = new PDO($dsn, $infoBdd['user'], $infoBdd['pass']);

        if ($this->db) {

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        $this->tableName = 'categorie_poids';
    }

    // Fonction getAll pour l'affichage des catégories dans le select (via listeBoxeurs.php)
    public function getAll(): ?array {
        $resultSet = null;

        $query = "SELECT * FROM {$this->tableName};";
        $reqPrep = $this->db->prepare($query);
        $rqtResult = $reqPrep->execute();

        if ($rqtResult) {

            $reqPrep->setFetchMode(PDO::FETCH_CLASS, CategoriePoids::class);
            $resultSet = $reqPrep->fetchAll();
        }

        return $resultSet;
    }

    // Fonction getById pour sélectionner toutes les variables en fonction de l'id 
    public function getById(int $id_categorie_poids): ?CategoriePoids {

        $resultSet = null;
        $query = "SELECT * FROM {$this->tableName} WHERE id_categorie_poids=:id_categorie_poids;";
        $reqPrep = $this->db->prepare($query);
        $rqtResult = $reqPrep->execute([':id_categorie_poids' => $id_categorie_poids]);

        if ($rqtResult !== false) {

            $reqPrep->setFetchMode(PDO::FETCH_CLASS, CategoriePoids::class);
            $tmp = $reqPrep->fetch();

            if ($tmp !== false)
                $resultSet = $tmp;
        }

        return $resultSet;
    }

    // Fonction exist pour voir si l'id voulu existe
    public function exist(CategoriePoids $categoriePoids): bool {

        $res = (!is_null($this->getById($categoriePoids->getId()))) ? true : false;
        return $res;
    }

}