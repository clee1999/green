<?php

namespace App\Entity;

use App\Repository\AccesVilleRepository;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass=AccesVilleRepository::class)
 */
class AccesVille implements JsonSerializable

{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code_iris;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $classement_score_global;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_iris;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $population;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score_global;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $acces_numerique;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $acces_information;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $competences_administrative;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $competence_numerique_scolaire;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $global_acces;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $global_competence;


    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'nom'=> $this->nom,
            'code_iris'=> $this->code_iris,
            'classement_score_global'=> $this->classement_score_global,
            'nom_iris'=> $this->nom_iris,
            'logpopulationin'=> $this->population,
            'score_global'=> $this->score_global,
            'acces_numerique'=> $this->acces_numerique,
            'acces_information'=> $this->acces_information,
            'competences_administrative'=> $this->competences_administrative,
            'competence_numerique_scolaire'=> $this->competence_numerique_scolaire,
            'global_acces'=> $this->global_acces,
            'global_competence'=> $this->global_competence,
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCodeIris(): ?string
    {
        return $this->code_iris;
    }

    public function setCodeIris(?string $code_iris): self
    {
        $this->code_iris = $code_iris;

        return $this;
    }

    public function getClassementScoreGlobal(): ?string
    {
        return $this->classement_score_global;
    }

    public function setClassementScoreGlobal(?string $classement_score_global): self
    {
        $this->classement_score_global = $classement_score_global;

        return $this;
    }

    public function getNomIris(): ?string
    {
        return $this->nom_iris;
    }

    public function setNomIris(?string $nom_iris): self
    {
        $this->nom_iris = $nom_iris;

        return $this;
    }

    public function getPopulation(): ?string
    {
        return $this->population;
    }

    public function setPopulation(?string $population): self
    {
        $this->population = $population;

        return $this;
    }

    public function getScoreGlobal(): ?int
    {
        return $this->score_global;
    }

    public function setScoreGlobal(?int $score_global): self
    {
        $this->score_global = $score_global;

        return $this;
    }

    public function getAccesNumerique(): ?int
    {
        return $this->acces_numerique;
    }

    public function setAccesNumerique(?int $acces_numerique): self
    {
        $this->acces_numerique = $acces_numerique;

        return $this;
    }

    public function getAccesInformation(): ?int
    {
        return $this->acces_information;
    }

    public function setAccesInformation(?int $acces_information): self
    {
        $this->acces_information = $acces_information;

        return $this;
    }

    public function getCompetencesAdministrative(): ?int
    {
        return $this->competences_administrative;
    }

    public function setCompetencesAdministrative(?int $competences_administrative): self
    {
        $this->competences_administrative = $competences_administrative;

        return $this;
    }

    public function getCompetenceNumeriqueScolaire(): ?int
    {
        return $this->competence_numerique_scolaire;
    }

    public function setCompetenceNumeriqueScolaire(?int $competence_numerique_scolaire): self
    {
        $this->competence_numerique_scolaire = $competence_numerique_scolaire;

        return $this;
    }

    public function getGlobalAcces(): ?int
    {
        return $this->global_acces;
    }

    public function setGlobalAcces(?int $global_acces): self
    {
        $this->global_acces = $global_acces;

        return $this;
    }

    public function getGlobalCompetence(): ?int
    {
        return $this->global_competence;
    }

    public function setGlobalCompetence(?int $global_competence): self
    {
        $this->global_competence = $global_competence;

        return $this;
    }
 
}
