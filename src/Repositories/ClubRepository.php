<?php
namespace Repositories;

use \PDO;
use Entities\Club;

class ClubRepository {

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

        $this->tableName = 'club';
    }

    // Fonction getAll pour sélectionner tous les clubs (via le select de formEditBoxeur.php)
    public function getAll(): ?array {

        $resultSet = null;
        $query = "SELECT * FROM {$this->tableName};";
        $reqPrep = $this->db->prepare($query);
        $rqtResult = $reqPrep->execute();

        if ($rqtResult) {

            $reqPrep->setFetchMode(PDO::FETCH_CLASS, Club::class);
            $resultSet = $reqPrep->fetchAll();
        }

        return $resultSet;
    }

    // Fonction getById pour sélectionner toutes les variables en fonction de l'id 
    public function getById(int $id_club): ?Club {

        $resultSet = null;
        $query = "SELECT * FROM {$this->tableName} WHERE id_club=:id_club;";
        $reqPrep = $this->db->prepare($query);
        $rqtResult = $reqPrep->execute([':id_club' => $id_club]);

        if ($rqtResult !== false) {

            $reqPrep->setFetchMode(PDO::FETCH_CLASS, Club::class);
            $tmp = $reqPrep->fetch();

            if ($tmp !== false)
                $resultSet = $tmp;
        }

        return $resultSet;
    }

    // Fonction exist pour voir si l'id voulu existe
    public function exist(Club $club): bool {
        $res = (!is_null($this->getById($club->getId()))) ? true : false;
        return $res;
    }

}