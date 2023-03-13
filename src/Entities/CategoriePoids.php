<?php
namespace Entities;

class CategoriePoids {
    protected ?int $id_categorie_poids = null;
    protected string $intitule; 
    protected string $ref;
    protected ?int $poids_min = null;
    protected ?int $poids_max = null;

    public function setId(?int $id_categorie_poids): self {
        if (is_null($this->id_categorie_poids)) {
            $this->id_categorie_poids = $id_categorie_poids;
        }
        return $this;
    }

    public function getId(): ?int {
        return $this->id_categorie_poids;
    }

    public function setIntitule(string $intitule): self {
        $this->intitule = substr(strtoupper($intitule), 0, 20);
        return $this;
    }

    public function getIntitule(): string {
        return $this->intitule;
    }

    public function setRef(string $ref): self {
        $this->ref = substr(strtoupper($ref), 0, 4);
        return $this;
    }

    public function getRef(): string {
        return $this->ref;
    }

    public function setPoidsMin(int $poids_min): self {
        $this->poids_min = substr(strtoupper($poids_min), 0, 11);;
        return $this;
    }

    public function getPoidsMin(): ?int {
        return $this->poids_min;
    }
    
    public function setPoidsMax(int $poids_max): self {
        $this->poids_max = substr(strtoupper($poids_max), 0, 11);;
        return $this;
    }

    public function getPoidsMax(): ?int {
        return $this->poids_max;
    }

    public function __construct(?array $data = null) {
        (isset($data['id_categorie_poids'])) ? $this->setId($data['id_categorie_poids']) : null;
        (isset($data['intitule'])) ? $this->setIntitule($data['intitule']): null;
        (isset($data['ref'])) ? $this->setRef($data['ref']) : null;
        (isset($data['poids_min']))? $this->setPoidsMin($data['poids_min']): null;
        (isset($data['poids_max']))? $this->setPoidsMax($data['poids_max']): null;
    }

}
