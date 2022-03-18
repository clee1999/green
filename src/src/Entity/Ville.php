<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
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
    private $Nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $code_iris;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $classement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_iris;

    /**
     * @ORM\Column(type="integer")
     */
    private $population;

    /**
     * @ORM\Column(type="integer")
     */
    private $score_global;

    /**
     * @ORM\Column(type="integer")
     */
    private $acces_interfaces_numerique;

    /**
     * @ORM\Column(type="integer")
     */
    private $acces_information;

    /**
     * @ORM\Column(type="integer")
     */
    private $competences_administratives;

    /**
     * @ORM\Column(type="integer")
     */
    private $competence_num_scolaire;

    /**
     * @ORM\Column(type="integer")
     */
    private $global_acces;

    /**
     * @ORM\Column(type="integer")
     */
    private $global_competences;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getCodeIris(): ?int
    {
        return $this->code_iris;
    }

    public function setCodeIris(int $code_iris): self
    {
        $this->code_iris = $code_iris;

        return $this;
    }

    public function getClassement(): ?string
    {
        return $this->classement;
    }

    public function setClassement(string $classement): self
    {
        $this->classement = $classement;

        return $this;
    }

    public function getNomIris(): ?string
    {
        return $this->nom_iris;
    }

    public function setNomIris(string $nom_iris): self
    {
        $this->nom_iris = $nom_iris;

        return $this;
    }

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function setPopulation(int $population): self
    {
        $this->population = $population;

        return $this;
    }

    public function getScoreGlobal(): ?int
    {
        return $this->score_global;
    }

    public function setScoreGlobal(int $score_global): self
    {
        $this->score_global = $score_global;

        return $this;
    }

    public function getAccesInterfacesNumerique(): ?int
    {
        return $this->acces_interfaces_numerique;
    }

    public function setAccesInterfacesNumerique(int $acces_interfaces_numerique): self
    {
        $this->acces_interfaces_numerique = $acces_interfaces_numerique;

        return $this;
    }

    public function getAccesInformation(): ?int
    {
        return $this->acces_information;
    }

    public function setAccesInformation(int $acces_information): self
    {
        $this->acces_information = $acces_information;

        return $this;
    }

    public function getCompetencesAdministratives(): ?int
    {
        return $this->competences_administratives;
    }

    public function setCompetencesAdministratives(int $competences_administratives): self
    {
        $this->competences_administratives = $competences_administratives;

        return $this;
    }

    public function getCompetenceNumScolaire(): ?int
    {
        return $this->competence_num_scolaire;
    }

    public function setCompetenceNumScolaire(int $competence_num_scolaire): self
    {
        $this->competence_num_scolaire = $competence_num_scolaire;

        return $this;
    }

    public function getGlobalAcces(): ?int
    {
        return $this->global_acces;
    }

    public function setGlobalAcces(int $global_acces): self
    {
        $this->global_acces = $global_acces;

        return $this;
    }

    public function getGlobalCompetences(): ?int
    {
        return $this->global_competences;
    }

    public function setGlobalCompetences(int $global_competences): self
    {
        $this->global_competences = $global_competences;

        return $this;
    }
}
