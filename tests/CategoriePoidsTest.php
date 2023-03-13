<?php

declare(strict_types=1);
require_once 'config/appConfig.php';

use PHPUnit\Framework\TestCase;
use Entities\CategoriePoids;
use Exceptions\EntityException;
use Exceptions\FormatParamException;

class CategoriePoidsTest extends TestCase {
    
    /**
     * Teste le constructeur sans paramètre
     */
    public function testConstructEmpty() {
        $this->expectException(\ArgumentCountError::class);

        $entity = new CategoriePoids();
    }
    
    /**
     * Teste le constructeur paramètre null
     */
    public function testConstructDatasNull() {
        $this->expectException(\TypeError::class);

        $entity = new CategoriePoids(null);
    }
 
    /**
     * Teste le constructeur tous les paramètre ok
     */
    public function testConstructDatasComplet() {
        $expected = [
            'id_categorie_poids' => 5,
            'intitule' => 'Légers',
            'ref' => 'F60',
            'poids_min' => 56,
            'poids_max' => 60,
        ];

        $entity = new CategoriePoids([
            'id_categorie_poids' => 5,
            'intitule' => 'Légers',
            'ref' => 'F60',
            'poids_min' => 56,
            'poids_max' => 60,
        ]);

        $this->assertSame($expected['id_categorie_poids'], $entity->getId_categorie_poids());
        $this->assertSame($expected['intitule'], $entity->getIntitule());
        $this->assertSame($expected['ref'], $entity->getRef());
        $this->assertSame($expected['poids_min'], $entity->getPoids_min());
        $this->assertSame($expected['poids_max'], $entity->getPoids_max());
    }
 
    /**
     * Teste le constructeur paramètre sans id
     */
    public function testConstructDatasSansId() {
        $expected = [
            'id_categorie_poids' => null,
            'intitule' => 'Légers',
            'ref' => 'F60',
            'poids_min' => 56,
            'poids_max' => 60,
        ];

        $entity = new CategoriePoids([
            'intitule' => 'Légers',
            'ref' => 'F60',
            'poids_min' => 56,
            'poids_max' => 60,
        ]);

        $this->assertSame($expected['id_categorie_poids'], $entity->getId_categorie_poids());
        $this->assertSame($expected['intitule'], $entity->getIntitule());
        $this->assertSame($expected['ref'], $entity->getRef());
        $this->assertSame($expected['poids_min'], $entity->getPoids_min());
        $this->assertSame($expected['poids_max'], $entity->getPoids_max());
    }
 
    /**
     * Teste les setters.
     * Vérifie le type du retour et la valeur de l'attibut
     */
    public function testSettersOk() {
        $expected = [
            'id_categorie_poids' => 5,
            'intitule' => 'Super-Mi-Moyens',
            'ref' => 'M75',
            'poids_min' => 70,
            'poids_max' => 75,
        ];

        $modif = [
            'id_categorie_poidsOK' => 5,
            'intituleOk' => 'Super-Mi-Moyens',
            'refOK' => 'M75',
            'poids_min' => 70,
            'poids_max' => 75,
        ];

        $entity = new CategoriePoids([
            'intitule' => 'Légers',
            'ref' => 'F60',
            'poids_min' => 56,
            'poids_max' => 60,
        ]);
        
        // Tests avec des valeurs OK
        $entMod = $entity->setId_categorie_poids($modif['id_categorie_poidsOK']);
        $this->assertInstanceOf(CategoriePoids::class, $entMod);
        $this->assertSame($expected['id_categorie_poids'], $entity->getId_categorie_poids());
        
        $entMod = $entity->setIntitule($modif['intituleOk']);
        $this->assertInstanceOf(CategoriePoids::class, $entMod);
        $this->assertSame($expected['intitule'], $entity->getIntitule());
        
        $entMod = $entity->setRef($modif['refOK']);
        $this->assertInstanceOf(CategoriePoids::class, $entMod);
        $this->assertSame($expected['ref'], $entity->getRef());
        
        $entMod = $entity->setPoids_max($modif['poids_max']);
        $this->assertInstanceOf(CategoriePoids::class, $entMod);
        $this->assertSame($expected['poids_max'], $entity->getPoids_max());
        
        $entMod = $entity->setPoids_min($modif['poids_min']);
        $this->assertInstanceOf(CategoriePoids::class, $entMod);
        $this->assertSame($expected['poids_min'], $entity->getPoids_min());
    }
 
    /**
     * Teste les setters avec des valeurs incorectes
     * Vérifie les exceptions lancés par les setters et les messages
     */
    public function testSettersExceptions() {
        $modif = [
            'id_categorie_poidsKO' => 6,
            'intituleKO' => 'Trop long, Trop long, Trop long, Trop long,',            
            'refKO' => 'M75M75',
            'poids_min' => 70,
            'poids_max' => 50,
            'poids_neg' => -10,
        ];

        $entity = new CategoriePoids([
            'id_categorie_poids' => 5,
            'intitule' => 'Légers',
            'ref' => 'F60',
            'poids_min' => 56,
            'poids_max' => 60,
        ]);
            
        
        // Teste id_categorie_poids sur une entité avec id_categorie_poids déjà affecté
        try {
            $entMod = $entity->setId_categorie_poids($modif['id_categorie_poidsKO']);
        } catch (Throwable $ex) {
            $this->assertInstanceOf(EntityException::class, $ex);
            $this->assertEquals('Modification id_categorie_poids impossible.', $ex->getMessage());
        }
        try {
            $entMod = $entity->setId_categorie_poids(null);
        } catch (Throwable $ex) {
            $this->assertInstanceOf(TypeError::class, $ex);
            $this->assertStringContainsString("must be of type int, null given", $ex->getMessage());
        }
        
        // Teste intitule avec des valeurs non conformes
        try {
            $entMod = $entity->setIntitule($modif['intituleKO']);
        } catch (Throwable $ex) {
            $this->assertInstanceOf(FormatParamException::class, $ex);
            $this->assertEquals('Erreur, intitule trop long.', $ex->getMessage());
        }
        try {
            $entMod = $entity->setIntitule(null);
        } catch (Throwable $ex) {
            $this->assertInstanceOf(TypeError::class, $ex);
            $this->assertStringContainsString('must be of type string, null given', $ex->getMessage());
        }
      
        // Teste ref avec des valeurs non conformes
        try {
            $entMod = $entity->setRef($modif['refKO']);
        } catch (Throwable $ex) {
            $this->assertInstanceOf(FormatParamException::class, $ex);
            $this->assertEquals('Erreur, ref trop long.', $ex->getMessage());
        }
        try {
            $entMod = $entity->setRef(null);
        } catch (Throwable $ex) {
            $this->assertInstanceOf(TypeError::class, $ex);
            $this->assertStringContainsString('must be of type string, null given', $ex->getMessage());
        }
      
        // Teste poids_min > poids_max et poids_min négatif
        try {
            $entMod = $entity->setPoids_min($modif['poids_min']);
        } catch (Throwable $ex) {
            $this->assertInstanceOf(EntityException::class, $ex);
            $this->assertEquals('poids > poids_max.', $ex->getMessage());
        }
        try {
            $entMod = $entity->setPoids_min($modif['poids_neg']);
        } catch (Throwable $ex) {
            $this->assertInstanceOf(FormatParamException::class, $ex);
            $this->assertEquals('Erreur, poids négatif.', $ex->getMessage());
        }
      
        // Teste poids_max < poids_min et poids_max négatif
        try {
            $entMod = $entity->setPoids_max($modif['poids_max']);
        } catch (Throwable $ex) {
            $this->assertInstanceOf(EntityException::class, $ex);
            $this->assertEquals('poids < poids_min.', $ex->getMessage());
        }
        try {
            $entMod = $entity->setPoids_max($modif['poids_neg']);
        } catch (Throwable $ex) {
            $this->assertInstanceOf(FormatParamException::class, $ex);
            $this->assertEquals('Erreur, poids négatif.', $ex->getMessage());
        }
    }
    
}
