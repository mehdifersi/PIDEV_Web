<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * DemandesDevis
 *
 * @ORM\Table(name="demandes_devis", indexes={@ORM\Index(name="FK_4B463CB078B0A977", columns={"id_prestataire"}), @ORM\Index(name="fk_demandedevisclient22", columns={"id_client"})})
 * @ORM\Entity(repositoryClass="App\Repository\DemandesDevisRepository")
 */
class DemandesDevis
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
     * @ORM\Column(name="ref", type="string", length=255, nullable=false)
     */
    private $ref;

    /**
     * @var string
     *
     * @ORM\Column(name="duree", type="string", length=255, nullable=false)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="mission", type="string", length=255, nullable=false)
     */
    private $mission;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commencement", type="date", nullable=false)
     */
    private $dateCommencement;

    /**
     * @var string
     *
     * @ORM\Column(name="traiter", type="string", length=255, nullable=false)
     */
    private $traiter;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id")
     * })
     */
    private $idClient;

    /**
     * @var \PrestataireService
     *
     * @ORM\ManyToOne(targetEntity="PrestataireService")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_prestataire", referencedColumnName="id")
     * })
     */
    private $idPrestataire;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getMission(): ?string
    {
        return $this->mission;
    }

    public function setMission(string $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getDateCommencement(): ?\DateTimeInterface
    {
        return $this->dateCommencement;
    }

    public function setDateCommencement(\DateTimeInterface $dateCommencement): self
    {
        $this->dateCommencement = $dateCommencement;

        return $this;
    }

    public function getTraiter(): ?string
    {
        return $this->traiter;
    }

    public function setTraiter(string $traiter): self
    {
        $this->traiter = $traiter;

        return $this;
    }

    public function getIdClient(): ?Users
    {
        return $this->idClient;
    }

    public function setIdClient(?Users $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    public function getIdPrestataire(): ?PrestataireService
    {
        return $this->idPrestataire;
    }

    public function setIdPrestataire(?PrestataireService $idPrestataire): self
    {
        $this->idPrestataire = $idPrestataire;

        return $this;
    }


}
