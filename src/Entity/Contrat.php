<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contrat
 *
 * @ORM\Table(name="contrat", indexes={@ORM\Index(name="fk_contrat_agent", columns={"agent"}), @ORM\Index(name="fk_contrat_client", columns={"client"}), @ORM\Index(name="fk_contrat_prop", columns={"propriete"}), @ORM\Index(name="fk_contrat_vendeur", columns={"vendeur"})})
 * @ORM\Entity
 */
class Contrat
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
     * @ORM\Column(name="reference", type="string", length=255, nullable=false)
     */
    private $reference;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cin_client", type="string", length=255, nullable=true)
     */
    private $cinClient;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_client", type="string", length=255, nullable=true)
     */
    private $nomClient;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cin_vendeur", type="string", length=255, nullable=true)
     */
    private $cinVendeur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_vendeur", type="string", length=255, nullable=true)
     */
    private $nomVendeur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_bien", type="string", length=255, nullable=true)
     */
    private $nomBien;

    /**
     * @var float|null
     *
     * @ORM\Column(name="prix_bien", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixBien;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_agent", type="string", length=255, nullable=true)
     */
    private $nomAgent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var \Agents
     *
     * @ORM\ManyToOne(targetEntity="Agents")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="agent", referencedColumnName="id")
     * })
     */
    private $agent;

    /**
     * @var \Clients
     *
     * @ORM\ManyToOne(targetEntity="Clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client", referencedColumnName="id")
     * })
     */
    private $client;

    /**
     * @var \Bien
     *
     * @ORM\ManyToOne(targetEntity="Bien")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="propriete", referencedColumnName="id")
     * })
     */
    private $propriete;

    /**
     * @var \Clients
     *
     * @ORM\ManyToOne(targetEntity="Clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vendeur", referencedColumnName="id")
     * })
     */
    private $vendeur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCinClient(): ?string
    {
        return $this->cinClient;
    }

    public function setCinClient(?string $cinClient): self
    {
        $this->cinClient = $cinClient;

        return $this;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(?string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getCinVendeur(): ?string
    {
        return $this->cinVendeur;
    }

    public function setCinVendeur(?string $cinVendeur): self
    {
        $this->cinVendeur = $cinVendeur;

        return $this;
    }

    public function getNomVendeur(): ?string
    {
        return $this->nomVendeur;
    }

    public function setNomVendeur(?string $nomVendeur): self
    {
        $this->nomVendeur = $nomVendeur;

        return $this;
    }

    public function getNomBien(): ?string
    {
        return $this->nomBien;
    }

    public function setNomBien(?string $nomBien): self
    {
        $this->nomBien = $nomBien;

        return $this;
    }

    public function getPrixBien(): ?float
    {
        return $this->prixBien;
    }

    public function setPrixBien(?float $prixBien): self
    {
        $this->prixBien = $prixBien;

        return $this;
    }

    public function getNomAgent(): ?string
    {
        return $this->nomAgent;
    }

    public function setNomAgent(?string $nomAgent): self
    {
        $this->nomAgent = $nomAgent;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAgent(): ?Agents
    {
        return $this->agent;
    }

    public function setAgent(?Agents $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(?Clients $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getPropriete(): ?Bien
    {
        return $this->propriete;
    }

    public function setPropriete(?Bien $propriete): self
    {
        $this->propriete = $propriete;

        return $this;
    }

    public function getVendeur(): ?Clients
    {
        return $this->vendeur;
    }

    public function setVendeur(?Clients $vendeur): self
    {
        $this->vendeur = $vendeur;

        return $this;
    }


}
