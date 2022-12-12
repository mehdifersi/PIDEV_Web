<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $avenue = null;

    #[ORM\Column(length: 255)]
    private ?int $numeroRue = null;


    #[Assert\NotBlank()]
    #[ORM\Column(length: 255)]

    private ?int $codePostal = null;

    #[ORM\ManyToOne(inversedBy: 'adresses')]
    #[Assert\NotBlank()]

    private ?Agence $id_Agence = null;

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
        return $this->id_Agence;
    }

    public function setIdAgence(?Agence $id_Agence): self
    {
        $this->id_Agence = $id_Agence;

        return $this;
    }

}
