<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Agence
 *
 * @ORM\Table(name="agence")
 * @ORM\Entity(repositoryClass="App\Repository\AgenceRepository")
 */
class Agence
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255, nullable=false)
     */
    private $region;

    /**
     * @var int
     *
     * @ORM\Column(name="numero_tel", type="integer", nullable=false)
     */
    private $numeroTel;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="web_site", type="string", length=255, nullable=false)
     */
    private $webSite;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_du_responsable", type="string", length=255, nullable=false)
     */
    private $nomDuResponsable;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_des_employees", type="integer", nullable=false)
     */
    private $nombreDesEmployees;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="jour_de_creation", type="date", nullable=false)
     */
    private $jourDeCreation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rate", type="integer", nullable=true)
     */
    private $rate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getNumeroTel(): ?int
    {
        return $this->numeroTel;
    }

    public function setNumeroTel(int $numeroTel): self
    {
        $this->numeroTel = $numeroTel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getWebSite(): ?string
    {
        return $this->webSite;
    }

    public function setWebSite(string $webSite): self
    {
        $this->webSite = $webSite;

        return $this;
    }

    public function getNomDuResponsable(): ?string
    {
        return $this->nomDuResponsable;
    }

    public function setNomDuResponsable(string $nomDuResponsable): self
    {
        $this->nomDuResponsable = $nomDuResponsable;

        return $this;
    }

    public function getNombreDesEmployees(): ?int
    {
        return $this->nombreDesEmployees;
    }

    public function setNombreDesEmployees(int $nombreDesEmployees): self
    {
        $this->nombreDesEmployees = $nombreDesEmployees;

        return $this;
    }

    public function getJourDeCreation(): ?\DateTimeInterface
    {
        return $this->jourDeCreation;
    }

    public function setJourDeCreation(\DateTimeInterface $jourDeCreation): self
    {
        $this->jourDeCreation = $jourDeCreation;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(?int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }


}
