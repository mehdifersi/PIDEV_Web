<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rapport
 *
 * @ORM\Table(name="rapport", indexes={@ORM\Index(name="rapport_ibfk_1", columns={"idBien"}), @ORM\Index(name="rapport_ibfk_2", columns={"idRDV"})})
 * @ORM\Entity
 */
class Rapport
{
    /**
     * @var int
     *
     * @ORM\Column(name="idRapport", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrapport;

    /**
     * @var string
     *
     * @ORM\Column(name="dateRDV", type="string", length=255, nullable=false)
     */
    private $daterdv;

    /**
     * @var int
     *
     * @ORM\Column(name="noteBien", type="integer", nullable=false)
     */
    private $notebien;

    /**
     * @var string
     *
     * @ORM\Column(name="etatBien", type="string", length=255, nullable=false)
     */
    private $etatbien;

    /**
     * @var string
     *
     * @ORM\Column(name="positionBien", type="string", length=255, nullable=false)
     */
    private $positionbien;

    /**
     * @var string
     *
     * @ORM\Column(name="voisinageBien", type="string", length=255, nullable=false)
     */
    private $voisinagebien;

    /**
     * @var \Bien
     *
     * @ORM\ManyToOne(targetEntity="Bien")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idBien", referencedColumnName="id")
     * })
     */
    private $idbien;

    /**
     * @var \RendezVous
     *
     * @ORM\ManyToOne(targetEntity="RendezVous")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idRDV", referencedColumnName="id")
     * })
     */
    private $idrdv;

    public function getIdrapport(): ?int
    {
        return $this->idrapport;
    }

    public function getDaterdv(): ?string
    {
        return $this->daterdv;
    }

    public function setDaterdv(string $daterdv): self
    {
        $this->daterdv = $daterdv;

        return $this;
    }

    public function getNotebien(): ?int
    {
        return $this->notebien;
    }

    public function setNotebien(int $notebien): self
    {
        $this->notebien = $notebien;

        return $this;
    }

    public function getEtatbien(): ?string
    {
        return $this->etatbien;
    }

    public function setEtatbien(string $etatbien): self
    {
        $this->etatbien = $etatbien;

        return $this;
    }

    public function getPositionbien(): ?string
    {
        return $this->positionbien;
    }

    public function setPositionbien(string $positionbien): self
    {
        $this->positionbien = $positionbien;

        return $this;
    }

    public function getVoisinagebien(): ?string
    {
        return $this->voisinagebien;
    }

    public function setVoisinagebien(string $voisinagebien): self
    {
        $this->voisinagebien = $voisinagebien;

        return $this;
    }

    public function getIdbien(): ?Bien
    {
        return $this->idbien;
    }

    public function setIdbien(?Bien $idbien): self
    {
        $this->idbien = $idbien;

        return $this;
    }

    public function getIdrdv(): ?RendezVous
    {
        return $this->idrdv;
    }

    public function setIdrdv(?RendezVous $idrdv): self
    {
        $this->idrdv = $idrdv;

        return $this;
    }


}
