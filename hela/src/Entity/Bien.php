<?php

namespace App\Entity;

use App\Repository\BienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: BienRepository::class)]
#[Vich\Uploadable]
class Bien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]

    public ?string $RefBien = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    public ?string $typeBien = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\NotBlank()]
    public ?float $prix = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\NotBlank()]
    public ?float $surfaceMetre = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]

    public ?string $description = null;



    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\NotBlank()]
    public?int $numRue = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    public ?string $ville = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\NotBlank()]
    public ?int $codePostal = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\Range(
        min: 11111111,
        max: 99999999,
        notInRangeMessage: 'numéro de téléphone  invalide',

    )]
    #[Assert\NotBlank()]
    public ?int $numTel = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email(
        message: 'email {{ value }} invalide.',
    )]
    #[Assert\NotBlank()]
    public ?string $adresseMail = null;

    #[ORM\OneToMany(mappedBy: 'refBien', targetEntity: Annonce::class ,cascade: ['remove','persist','merge'],orphanRemoval: true)]
    private Collection $annonces;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefBien(): ?string
    {
        return $this->RefBien;
    }

    public function setRefBien(string $RefBien): self
    {
        $this->RefBien = $RefBien;

        return $this;
    }

    public function getTypeBien(): string
    {
        return $this->typeBien;
    }

    public function setTypeBien(string $typeBien): self
    {
        $this->typeBien = $typeBien;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getSurfaceMetre(): ?float
    {
        return $this->surfaceMetre;
    }

    public function setSurfaceMetre(float $surfaceMetre): self
    {
        $this->surfaceMetre = $surfaceMetre;

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



    public function getNumRue(): ?int
    {
        return $this->numRue;
    }

    public function setNumRue(int $numRue): self
    {
        $this->numRue = $numRue;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

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

    public function getNumTel(): ?int
    {
        return $this->numTel;
    }

    public function setNumTel(int $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->adresseMail;
    }

    public function setAdresseMail(string $adresseMail): self
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }

    /**
     * @return Collection<int, Annonce>
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces->add($annonce);
            $annonce->setRefBien($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getRefBien() === $this) {
                $annonce->setRefBien(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        $a = 'Type: '. $this->getTypeBien() . '| Prix: '. $this->getPrix() . '| Description: ' . $this->getDescription() .'| Adresse: '. $this->getNumRue() .' '. $this->getVille() .' '. $this->getCodePostal() . '| Description: ' . $this->getDescription() . '| Telephone: ' . $this->getNumTel(). '| Email: '. $this->getAdresseMail();
        return $a;
    }
}
