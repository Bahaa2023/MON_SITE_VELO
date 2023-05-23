<?php

namespace App\Entity;

use App\Repository\CapacitebatterieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CapacitebatterieRepository::class)
 */
class Capacitebatterie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $capacite_batterie;

    /**
     * @ORM\OneToMany(targetEntity=Velos::class, mappedBy="batterie")
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

    public function getcapaciteBatterie(): ?string
    {
        return $this->capacite_batterie;
    }

    public function setcapaciteBatterie(string $capacite_batterie): self
    {
        $this->capacite_batterie = $capacite_batterie;

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
            $velo->setcapacitebatterie($this);
        }

        return $this;
    }

    public function removeVelo(Velos $velo): self
    {
        if ($this->velos->removeElement($velo)) {
            // set the owning side to null (unless already changed)
            if ($velo->getcapacitebatterie() === $this) {
                $velo->setcapacitebatterie(null);
            }
        }

        return $this;
    }
}
