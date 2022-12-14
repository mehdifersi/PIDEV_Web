<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce", indexes={@ORM\Index(name="IDX_F65593E57981EBDF", columns={"ref_bien_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\AnnonceRepository")
 */
class Annonce
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
     * @ORM\Column(name="ref_annonce", type="string", length=255, nullable=false)
     */
    private $refAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_annonce", type="string", length=255, nullable=false)
     */
    private $titreAnnonce;

    /**
     * @var string|null
     *
     * @ORM\Column(name="affiche_annonce", type="string", length=255, nullable=true)
     */
    private $afficheAnnonce;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_depot", type="date", nullable=false)
     */
    private $dateDepot;

    /**
     * @var \Bien
     *
     * @ORM\ManyToOne(targetEntity="Bien")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ref_bien_id", referencedColumnName="id")
     * })
     */
    private $refBien;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefAnnonce(): ?string
    {
        return $this->refAnnonce;
    }

    public function setRefAnnonce(string $refAnnonce): self
    {
        $this->refAnnonce = $refAnnonce;

        return $this;
    }

    public function getTitreAnnonce(): ?string
    {
        return $this->titreAnnonce;
    }

    public function setTitreAnnonce(string $titreAnnonce): self
    {
        $this->titreAnnonce = $titreAnnonce;

        return $this;
    }

    public function getAfficheAnnonce(): ?string
    {
        return $this->afficheAnnonce;
    }

    public function setAfficheAnnonce(?string $afficheAnnonce): self
    {
        $this->afficheAnnonce = $afficheAnnonce;

        return $this;
    }

    public function getDateDepot(): ?\DateTimeInterface
    {
        return $this->dateDepot;
    }

    public function setDateDepot(\DateTimeInterface $dateDepot): self
    {
        $this->dateDepot = $dateDepot;

        return $this;
    }

    public function getRefBien(): ?Bien
    {
        return $this->refBien;
    }

    public function setRefBien(?Bien $refBien): self
    {
        $this->refBien = $refBien;

        return $this;
    }


}
