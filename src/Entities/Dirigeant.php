<?php

namespace Entities; 

class Dirigeant {

    protected ?int $id_dirigeant = null;
    protected string $nom = 'INCONNU';
    protected string $prenom = 'Inconnu';
    protected string $login;
    protected string $pass;
    protected ?int $id_club = null;

    // La relation avec la table club

    private ?Club $club = null; 

    public function setId(?int $id_dirigeant): self {
        if (is_null($this->id_dirigeant)) {
            $this->id_dirigeant = $id_drigeant;
        }
        return $this;
    }

    public function getId(): ?int {
        return $this->id_dirigeant;
    }

    public function setNom(string $nom): void {
        $this->nom = substr(strtoupper($nom), 0, 45); 
    }

    public function getNom(): string {
        return $this->nom; 
    }

    public function setPrenom(string $prenom): void {
        $this->prenom = substr(strtoupper($prenom), 0, 45); 
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function setLogin(string $login): void {
        $this->login = substr(strtoupper($login), 0, 25);
    }

    public function getLogin(): string {
        return $this->login; 
    }

    public function setPassword(string $pass): void {
        $this->pass = substr($pass, 0, 128);
    }

    public function getPassword(): string {
        return $this->pass;
    }

    public function getIdClub() : ?int {
        return $this->id_club; 
    }


    // Fontion getClub en relation avec la table club
    public function getClub(): ?Club {
        if (is_null($this->club) || ($this->club->getId() != $this->id_club)) {
            if (!is_null($this->id_club)) {
                $mapper = new \Repositories\ClubRepository();
                $this->club = $mapper->getById($this->id_club);
            } else {
                $this->club = null;
            }
        }
        return $this->club;
    }

    public function setIdClub(?int $val = null): self {
        $this->id_club = $val;
        if (!is_null($this->club) && ($this->club->getId() != $this->id_club)) {
            $this->getClub();
        }

        return $this;
    }

    public function __construct(?array $datas = null) {
        (isset($datas['id_dirigeant'])) ? $this->setId($datas['id_dirigeant']) : null;
        (isset($datas['nom'])) ? $this->setNom($datas['nom']) : null;
        (isset($datas['prenom'])) ? $this->setPrenom($datas['prenom']) : null;
        (isset($datas['login'])) ? $this->setLogin($datas['login']) : null;
        (isset($datas['pass'])) ? $this->setPassword($datas['pass']) : null;
        (isset($datas['id_club'])) ? $this->setIdClub($datas['id_club']) : null;
    }
}