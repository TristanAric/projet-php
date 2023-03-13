<?php
namespace Entities;

class Club {
    protected ?int $id_club = null;
    protected string $nom_club = 'non renseigné';
    protected string $ville = 'non renseignée';
    protected ?int $affiliation = null;
    protected int $departement;

    public function setId(?int $id_club): self {
        if (is_null($this->id_club)) {
            $this->id_club = $id_club;
        }
        return $this;
    }

    public function getId(): ?int {
        return $this->id_club;
    }

    public function setNom(string $nom_club): self {
        $this->nom = substr(strtoupper($nom_club), 0, 45);
        return $this;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function setVille(string $ville): self {
        $this->ville = substr(strtoupper($ville), 0, 45);
        return $this;
    }

    public function getVille(): string {
        return $this->ville;
    }

    public function setAffiliation(?int $affiliation): self {
        $this->affiliation = substr(strtoupper($affiliation), 0, 11);
        return $this;
    }

    public function getAffiliation():?int {
        return $this->affiliation;
    }
    
    public function setDepartement(int $departement): self {
        $this->departement = substr(strtoupper($departement), 0, 11);;
        return $this;
    }

    public function getDepartement(): int {
        return $this->departement;
    }

    public function __construct(?array $data = null) {
        (isset($data['id_club'])) ? $this->setId($data['id_club']) : null;
        (isset($data['nom_club'])) ? $this->setNomClub($data['nom_club']): null;
        (isset($data['ville'])) ? $this->setVille($data['ville']) : null;
        (isset($data['affiliation']))? $this->setAffiliation($data['affiliation']): null;
        (isset($data['departement']))? $this->setDepartement($data['departement']): null;
    }

}