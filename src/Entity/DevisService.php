<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * DevisService
 *
 * @ORM\Table(name="devis_service", indexes={@ORM\Index(name="id_client", columns={"id_client"}), @ORM\Index(name="id_prestataitre", columns={"id_prestataitre"})})
 * @ORM\Entity
 */
class DevisService
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
     * @ORM\Column(name="nom_client", type="string", length=255, nullable=false)
     */
    private $nomClient;

    /**
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=255, nullable=false)
     */
    private $ref;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_commercial", type="string", length=255, nullable=false)
     */
    private $nomCommercial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="valable_jusqu_à", type="date", nullable=false)
     */
    private $valableJusquà;

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
     * @var float
     *
     * @ORM\Column(name="prix_ttc", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixTtc;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_ht", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixHt;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var \PrestataireService
     *
     * @ORM\ManyToOne(targetEntity="PrestataireService")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_prestataitre", referencedColumnName="id")
     * })
     */
    private $idPrestataitre;

    /**
     * @var \Clients
     *
     * @ORM\ManyToOne(targetEntity="Clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id")
     * })
     */
    private $idClient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
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

    public function getNomCommercial(): ?string
    {
        return $this->nomCommercial;
    }

    public function setNomCommercial(string $nomCommercial): self
    {
        $this->nomCommercial = $nomCommercial;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getValableJusquà(): ?\DateTimeInterface
    {
        return $this->valableJusquà;
    }

    public function setValableJusquà(\DateTimeInterface $valableJusquà): self
    {
        $this->valableJusquà = $valableJusquà;

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

    public function getPrixTtc(): ?float
    {
        return $this->prixTtc;
    }

    public function setPrixTtc(float $prixTtc): self
    {
        $this->prixTtc = $prixTtc;

        return $this;
    }

    public function getPrixHt(): ?float
    {
        return $this->prixHt;
    }

    public function setPrixHt(float $prixHt): self
    {
        $this->prixHt = $prixHt;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIdPrestataitre(): ?PrestataireService
    {
        return $this->idPrestataitre;
    }

    public function setIdPrestataitre(?PrestataireService $idPrestataitre): self
    {
        $this->idPrestataitre = $idPrestataitre;

        return $this;
    }

    public function getIdClient(): ?Clients
    {
        return $this->idClient;
    }

    public function setIdClient(?Clients $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }


}
