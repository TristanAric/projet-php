<?php

namespace Repositories;

use \PDO;
use Entities\Dirigeant; 

class DirigeantRepository {
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

        $this->tableName = 'Dirigeant';
    }

    // Fonction authentify pour reconnaitre un identifiant et mdp entré par l'utilisateur en fonction des infos de la base de données 
    public function authentify(Dirigeant $dirigeant) : ?bool {

        $resultSet = null;
        $_SESSION['login'] = false;
        $query = "SELECT * FROM {$this->tableName} WHERE login=:login;";    
        $reqPrep = $this->db->prepare($query);
        $rqtResult = $reqPrep->execute([':login' => $dirigeant->getLogin()]);
    
        if ($rqtResult) {

            $reqPrep->setFetchMode(PDO::FETCH_CLASS, Dirigeant::class);
            $resultSet = $reqPrep->fetch();
            $passwordVerify = password_verify($dirigeant->getPassword(), $resultSet->getPassword()); 
    
            if ($passwordVerify === true) {

                $_SESSION['login'] = true;
                $_SESSION['nom_user'] = $resultSet->getNom();
                $_SESSION['prenom_user'] = $resultSet->getPrenom();
                header('Location: index.php'.$_SESSION['nom_user'].$_SESSION['prenom_user'].$_SESSION['login']);
                return true;
            } else {

                header('Location: index.php'.$_SESSION['login']);
                return false;
            }
        }

        header('Location: index.php'.$_SESSION['login']);
        return $resultSet; 
    }

}   