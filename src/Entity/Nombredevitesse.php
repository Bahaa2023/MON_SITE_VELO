<?php

namespace App\Entity;

use App\Repository\NombredevitesseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NombredevitesseRepository::class)
 */
class Nombredevitesse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_vitesse;

    /**
     * @ORM\OneToMany(targetEntity=Velos::class, mappedBy="vitesse")
     */
    private $velos;

    public function __construct()
    {
        $this->velos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreVitesse(): ?int
    {
        return $this->nombre_vitesse;
    }

    public function setNombreVitesse(int $nombre_vitesse): self
    {
        $this->nombre_vitesse = $nombre_vitesse;

        return $this;
    }

    /**
     * @return Collection<int, Velos>
     */
    public function getVelos(): Collection
    {
        return $this->velos;
    }

    public function addVelo(Velos $velo): self
    {
        if (!$this->velos->contains($velo)) {
            $this->velos[] = $velo;
            $velo->setVitesse($this);
        }

        return $this;
    }

    public function removeVelo(Velos $velo): self
    {
        if ($this->velos->removeElement($velo)) {
            // set the owning side to null (unless already changed)
            if ($velo->getVitesse() === $this) {
                $velo->setVitesse(null);
            }
        }

        return $this;
    }
}
