<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtatBiens
 *
 * @ORM\Table(name="etat_biens", indexes={@ORM\Index(name="fk_etat_prop", columns={"id_bien"})})
 * @ORM\Entity
 */
class EtatBiens
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
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_pannes", type="integer", nullable=false)
     */
    private $nombrePannes;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var \Bien
     *
     * @ORM\ManyToOne(targetEntity="Bien")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_bien", referencedColumnName="id")
     * })
     */
    private $idBien;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getNombrePannes(): ?int
    {
        return $this->nombrePannes;
    }

    public function setNombrePannes(int $nombrePannes): self
    {
        $this->nombrePannes = $nombrePannes;

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

    public function getIdBien(): ?Bien
    {
        return $this->idBien;
    }

    public function setIdBien(?Bien $idBien): self
    {
        $this->idBien = $idBien;

        return $this;
    }


}
