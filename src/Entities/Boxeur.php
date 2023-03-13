<?php

namespace Entities;

class Boxeur {

    protected ?int $id_boxeur = null;
    protected string $nom = 'INCONNU';
    protected string $prenom = 'Inconnu';
    protected string $sexe;
    protected string $num_licence;
    protected ?int $id_club = null;
    protected ?int $id_categorie_poids = null;
    
    //  La relation avec club et poids
    private ?Club $club = null;
    private ?CategoriePoids $categoriePoids = null;

    public function setId(?int $id_boxeur): self {
        if (is_null($this->id_boxeur)) {
            $this->id_boxeur = $id_boxeur;
        }
        return $this;
    }

    public function getId(): ?int {
        return $this->id_boxeur;
    }

    public function setNom(string $nom): void {
        $this->nom = substr(strtoupper($nom), 0, 45);
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function setPrenom(string $prenom): void {
        $this->prenom = substr($prenom, 0, 45);
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function setSexe(string $sexe): void {
        $this->sexe = substr(strtoupper($sexe), 0, 1);
    }

    public function getSexe(): string {
        return $this->sexe;
    }

    public function setLicence(int $num_licence): void {
        $this->num_licence = substr(strtoupper($num_licence), 0, 11);
    }

    public function getLicence(): int {
        return $this->num_licence;
    }

    public function getIdClub(): ?int {
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

    public function getIdCategoriePoids(): ?int {
        return $this->id_categorie_poids;
    }

    // Fontion getCategoriePoids en relation avec la table categorie_poids
    public function getCategoriePoids(): ?CategoriePoids {
        if (is_null($this->categoriePoids) || ($this->categoriePoids->getId() != $this->id_categorie_poids)) {
            if (!is_null($this->id_categorie_poids)) {
                $mapper = new \Repositories\CategoriePoidsRepository();
                $this->categoriePoids = $mapper->getById($this->id_categorie_poids);
            } else {
                $this->categoriePoids = null;
            }
        }
        return $this->categoriePoids;
    }

    public function setIdCategoriePoids(?int $val = null): self {
        $this->id_categorie_poids = $val;
        if (!is_null($this->categoriePoids) && ($this->categoriePoids->getId() != $this->id_categorie_poids)) {
            $this->getCategoriePoids();
        }

        return $this;
    }

    public function __construct(?array $datas = null) {
        (isset($datas['id_boxeur'])) ? $this->setId($datas['id_boxeur']) : null;
        (isset($datas['nom'])) ? $this->setNom($datas['nom']) : null;
        (isset($datas['prenom'])) ? $this->setPrenom($datas['prenom']) : null;
        (isset($datas['sexe'])) ? $this->setSexe($datas['sexe']) : null;
        (isset($datas['num_licence'])) ? $this->setLicence($datas['num_licence']) : null;
        (isset($datas['id_club'])) ? $this->setIdClub($datas['id_club']) : null;
        (isset($datas['id_categorie_poids'])) ? $this->setIdCategoriePoids($datas['id_categorie_poids']) : null;
    }

}
