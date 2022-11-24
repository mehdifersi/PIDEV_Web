<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Agence
 *
 * @ORM\Table(name="agence")
 * @ORM\Entity
 */
class Agence
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAgence", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idagence;

    /**
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=255, nullable=false)
     */
    private $ref;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroTel", type="string", length=255, nullable=false)
     */
    private $numerotel;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="siteWeb", type="string", length=255, nullable=false)
     */
    private $siteweb;

    /**
     * @var string
     *
     * @ORM\Column(name="nomDuResponsable", type="string", length=255, nullable=false)
     */
    private $nomduresponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreDesEmployees", type="string", length=255, nullable=false)
     */
    private $nombredesemployees;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="jourDeCreation", type="date", nullable=false)
     */
    private $jourdecreation;

    public function getIdagence(): ?int
    {
        return $this->idagence;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getNumerotel(): ?string
    {
        return $this->numerotel;
    }

    public function setNumerotel(string $numerotel): self
    {
        $this->numerotel = $numerotel;

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

    public function getSiteweb(): ?string
    {
        return $this->siteweb;
    }

    public function setSiteweb(string $siteweb): self
    {
        $this->siteweb = $siteweb;

        return $this;
    }

    public function getNomduresponsable(): ?string
    {
        return $this->nomduresponsable;
    }

    public function setNomduresponsable(string $nomduresponsable): self
    {
        $this->nomduresponsable = $nomduresponsable;

        return $this;
    }

    public function getNombredesemployees(): ?string
    {
        return $this->nombredesemployees;
    }

    public function setNombredesemployees(string $nombredesemployees): self
    {
        $this->nombredesemployees = $nombredesemployees;

        return $this;
    }

    public function getJourdecreation(): ?\DateTimeInterface
    {
        return $this->jourdecreation;
    }

    public function setJourdecreation(\DateTimeInterface $jourdecreation): self
    {
        $this->jourdecreation = $jourdecreation;

        return $this;
    }


}
