<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AgenceRepository::class)]
class  Agence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex(
        pattern: '/^[a-z]+$/i',
        htmlPattern: '^[a-zA-Z]+$'
    )]
    #[Assert\NotBlank()]

    private ?string $region = null;

    #[ORM\Column]
    #[Assert\Positive]
    #[Assert\NotBlank()]

    private ?int $numeroTel = null;


    #[ORM\Column(length: 255)]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    #[Assert\NotBlank()]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]

    private ?string $webSite = null;

    #[ORM\Column(length: 255)]

    #[Assert\NotBlank()]
    private ?string $nomDuResponsable = null;

    #[ORM\Column]
    #[Assert\NotBlank()]
    private ?int $nombreDesEmployees = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $jourDeCreation = null;

    #[ORM\OneToMany(mappedBy: 'id_Agence', targetEntity: Adresse::class)]
    private Collection $adresses;

    #[ORM\Column(nullable: true)]
    private ?int $rate = null;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Adresse>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses->add($adress);
            $adress->setIdAgence($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getIdAgence() === $this) {
                $adress->setIdAgence(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return(string) $this->getRegion();
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
