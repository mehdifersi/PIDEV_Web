<?php

namespace App\Entity;

use App\Repository\RatingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\Entity(repositoryClass: RatingRepository::class)]
#[UniqueEntity('Cin')]
class Rating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Cin = null;

    #[ORM\Column]
    private ?int $RatingScore = null;

    #[ORM\ManyToOne]
    private ?Agence $Region = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?int
    {
        return $this->Cin;
    }

    public function setCin(int $Cin): self
    {
        $this->Cin = $Cin;

        return $this;
    }

    public function getRatingScore(): ?int
    {
        return $this->RatingScore;
    }

    public function setRatingScore(int $RatingScore): self
    {
        $this->RatingScore = $RatingScore;

        return $this;
    }

    public function getRegion(): ?Agence
    {
        return $this->Region;
    }

    public function setRegion(?Agence $Region): self
    {
        $this->Region = $Region;

        return $this;
    }
}
