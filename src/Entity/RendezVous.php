<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * RendezVous
 *
 * @ORM\Table(name="rendez_vous")
 * @ORM\Entity(repositoryClass="App\Repository\RendezVousRepository")
 */
class RendezVous
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateRDV", type="date", nullable=false)
     */
    private $daterdv;

    /**
     * @var int
     *
     * @ORM\Column(name="idC1", type="integer", nullable=false)
     */
    private $idc1;

    /**
     * @var int
     *
     * @ORM\Column(name="idC2", type="integer", nullable=false)
     */
    private $idc2;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuRDV", type="string", length=255, nullable=false)
     */
    private $lieurdv;

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

    public function getDaterdv(): ?\DateTimeInterface
    {
        return $this->daterdv;
    }

    public function setDaterdv(\DateTimeInterface $daterdv): self
    {
        $this->daterdv = $daterdv;

        return $this;
    }

    public function getIdc1(): ?int
    {
        return $this->idc1;
    }

    public function setIdc1(int $idc1): self
    {
        $this->idc1 = $idc1;

        return $this;
    }

    public function getIdc2(): ?int
    {
        return $this->idc2;
    }

    public function setIdc2(int $idc2): self
    {
        $this->idc2 = $idc2;

        return $this;
    }

    public function getLieurdv(): ?string
    {
        return $this->lieurdv;
    }

    public function setLieurdv(string $lieurdv): self
    {
        $this->lieurdv = $lieurdv;

        return $this;
    }
    public function __toString()
    {
       return (string) $this->getRef();
    }
}
