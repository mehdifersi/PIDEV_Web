<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse")
 * @ORM\Entity
 */
class Adresse
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
     * @ORM\Column(name="avenue", type="string", length=255, nullable=false)
     */
    private $avenue;

    /**
     * @var int
     *
     * @ORM\Column(name="numeroRue", type="integer", nullable=false)
     */
    private $numerorue;

    /**
     * @var string
     *
     * @ORM\Column(name="codePostal", type="string", length=255, nullable=false)
     */
    private $codepostal;

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

    public function getAvenue(): ?string
    {
        return $this->avenue;
    }

    public function setAvenue(string $avenue): self
    {
        $this->avenue = $avenue;

        return $this;
    }

    public function getNumerorue(): ?int
    {
        return $this->numerorue;
    }

    public function setNumerorue(int $numerorue): self
    {
        $this->numerorue = $numerorue;

        return $this;
    }

    public function getCodepostal(): ?string
    {
        return $this->codepostal;
    }

    public function setCodepostal(string $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }


}
