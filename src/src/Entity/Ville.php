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
    private $Name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Departement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Epci;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Region;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Pop;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ScoreGolbalDepartement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ScoreGlobalEpci;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ScoreGlobalRegion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ScoreGlobalDepartement2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ScoreGobalEpci2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ScoreGobalRegion2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Geometrie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Lattitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Longitude;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->Departement;
    }

    public function setDepartement(?string $Departement): self
    {
        $this->Departement = $Departement;

        return $this;
    }

    public function getEpci(): ?string
    {
        return $this->Epci;
    }

    public function setEpci(?string $Epci): self
    {
        $this->Epci = $Epci;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->Region;
    }

    public function setRegion(string $Region): self
    {
        $this->Region = $Region;

        return $this;
    }

    public function getPop(): ?string
    {
        return $this->Pop;
    }

    public function setPop(string $Pop): self
    {
        $this->Pop = $Pop;

        return $this;
    }

    public function getScoreGolbalDepartement(): ?string
    {
        return $this->ScoreGolbalDepartement;
    }

    public function setScoreGolbalDepartement(?string $ScoreGolbalDepartement): self
    {
        $this->ScoreGolbalDepartement = $ScoreGolbalDepartement;

        return $this;
    }

    public function getScoreGlobalEpci(): ?string
    {
        return $this->ScoreGlobalEpci;
    }

    public function setScoreGlobalEpci(?string $ScoreGlobalEpci): self
    {
        $this->ScoreGlobalEpci = $ScoreGlobalEpci;

        return $this;
    }

    public function getScoreGlobalRegion(): ?string
    {
        return $this->ScoreGlobalRegion;
    }

    public function setScoreGlobalRegion(?string $ScoreGlobalRegion): self
    {
        $this->ScoreGlobalRegion = $ScoreGlobalRegion;

        return $this;
    }

    public function getScoreGlobalDepartement2(): ?string
    {
        return $this->ScoreGlobalDepartement2;
    }

    public function setScoreGlobalDepartement2(?string $ScoreGlobalDepartement2): self
    {
        $this->ScoreGlobalDepartement2 = $ScoreGlobalDepartement2;

        return $this;
    }

    public function getScoreGobalEpci2(): ?string
    {
        return $this->ScoreGobalEpci2;
    }

    public function setScoreGobalEpci2(?string $ScoreGobalEpci2): self
    {
        $this->ScoreGobalEpci2 = $ScoreGobalEpci2;

        return $this;
    }

    public function getScoreGobalRegion2(): ?string
    {
        return $this->ScoreGobalRegion2;
    }

    public function setScoreGobalRegion2(?string $ScoreGobalRegion2): self
    {
        $this->ScoreGobalRegion2 = $ScoreGobalRegion2;

        return $this;
    }

    public function getGeometrie(): ?string
    {
        return $this->Geometrie;
    }

    public function setGeometrie(?string $Geometrie): self
    {
        $this->Geometrie = $Geometrie;

        return $this;
    }

    public function getLattitude(): ?string
    {
        return $this->Lattitude;
    }

    public function setLattitude(string $Lattitude): self
    {
        $this->Lattitude = $Lattitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->Longitude;
    }

    public function setLongitude(string $Longitude): self
    {
        $this->Longitude = $Longitude;

        return $this;
    }
}
