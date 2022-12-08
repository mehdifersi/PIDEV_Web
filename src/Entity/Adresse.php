<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse", indexes={@ORM\Index(name="fk_adresse_agence", columns={"id_agence_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\AdresseRepository")
 */
class Adresse
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
     * @ORM\Column(name="avenue", type="string", length=255, nullable=false)
     */
    private $avenue;

    /**
     * @var int
     *
     * @ORM\Column(name="numero_rue", type="integer", nullable=false)
     */
    private $numeroRue;

    /**
     * @var int
     *
     * @ORM\Column(name="code_postal", type="integer", nullable=false)
     */
    private $codePostal;

    /**
     * @var \Agence
     *
     * @ORM\ManyToOne(targetEntity="Agence")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_agence_id", referencedColumnName="id")
     * })
     */
    private $idAgence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvenue(): ?string
    {
        return $this->avenue;
    }

    public function setAvenue(string $avenue): self
    {
        $this->avenue = $avenue;

        return $this;
    }

    public function getNumeroRue(): ?int
    {
        return $this->numeroRue;
    }

    public function setNumeroRue(int $numeroRue): self
    {
        $this->numeroRue = $numeroRue;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getIdAgence(): ?Agence
    {
        return $this->idAgence;
    }

    public function setIdAgence(?Agence $idAgence): self
    {
        $this->idAgence = $idAgence;

        return $this;
    }


}
