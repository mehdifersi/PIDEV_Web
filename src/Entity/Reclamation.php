<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="App\Repository\ReclamationRepository")
 */
class Reclamation
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
     * @ORM\Column(name="type_rec", type="string", length=255, nullable=false)
     */
    private $typeRec;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer", nullable=false)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="id_agent", type="integer", nullable=false)
     */
    private $idAgent;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_plateforme", type="string", length=255, nullable=false)
     */
    private $etatPlateforme;

    /**
     * @var string
     *
     * @ORM\Column(name="service_agent", type="string", length=255, nullable=false)
     */
    private $serviceAgent;

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

    public function getTypeRec(): ?string
    {
        return $this->typeRec;
    }

    public function setTypeRec(string $typeRec): self
    {
        $this->typeRec = $typeRec;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

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

    public function getIdAgent(): ?int
    {
        return $this->idAgent;
    }

    public function setIdAgent(int $idAgent): self
    {
        $this->idAgent = $idAgent;

        return $this;
    }

    public function getEtatPlateforme(): ?string
    {
        return $this->etatPlateforme;
    }

    public function setEtatPlateforme(string $etatPlateforme): self
    {
        $this->etatPlateforme = $etatPlateforme;

        return $this;
    }

    public function getServiceAgent(): ?string
    {
        return $this->serviceAgent;
    }

    public function setServiceAgent(string $serviceAgent): self
    {
        $this->serviceAgent = $serviceAgent;

        return $this;
    }


}
