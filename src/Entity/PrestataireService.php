<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PrestataireService
 *
 * @ORM\Table(name="prestataire_service")
 * @ORM\Entity(repositoryClass="App\Repository\PrestataireServiceRepository")
 */
class PrestataireService
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
     * @ORM\Column(name="nom_commercial", type="string", length=255, nullable=false)
     */
    private $nomCommercial;

    /**
     * @var string
     *
     * @ORM\Column(name="domaine_service", type="string", length=255, nullable=false)
     */
    private $domaineService;

    /**
     * @var string
     *
     * @ORM\Column(name="num_tel", type="string", length=255, nullable=false)
     */
    private $numTel;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

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

    public function getNomCommercial(): ?string
    {
        return $this->nomCommercial;
    }

    public function setNomCommercial(string $nomCommercial): self
    {
        $this->nomCommercial = $nomCommercial;

        return $this;
    }

    public function getDomaineService(): ?string
    {
        return $this->domaineService;
    }

    public function setDomaineService(string $domaineService): self
    {
        $this->domaineService = $domaineService;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): self
    {
        $this->numTel = $numTel;

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

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this->nomCommercial;
    }


}
