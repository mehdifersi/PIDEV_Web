<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAware;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
#[Vich\Uploadable]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]

    private ?string $refAnnonce = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $titreAnnonce = null;

    #[ORM\Column(length: 255)]

    private ?string $afficheAnnonce = null;




    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank()]
    private ?\DateTimeInterface $dateDepot = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    #[ORM\JoinColumn(nullable: false)]
    public ?Bien $refBien = null;

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

    public function setAfficheAnnonce(string $afficheAnnonce): self
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
    public function __toString()
    {
        return(string) $this->getDateDepot();
    }
}
