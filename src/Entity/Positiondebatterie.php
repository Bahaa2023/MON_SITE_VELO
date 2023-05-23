<?php

namespace App\Entity;

use App\Repository\PositiondebatterieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PositiondebatterieRepository::class)
 */
class Positiondebatterie
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
    private $position_batterie;

    /**
     * @ORM\OneToMany(targetEntity=Velos::class, mappedBy="positiondebatterie")
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

    public function getPositionBatterie(): ?string
    {
        return $this->position_batterie;
    }

    public function setPositionBatterie(string $position_batterie): self
    {
        $this->position_batterie = $position_batterie;

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
            $velo->setPositiondebatterie($this);
        }

        return $this;
    }

    public function removeVelo(Velos $velo): self
    {
        if ($this->velos->removeElement($velo)) {
            // set the owning side to null (unless already changed)
            if ($velo->getPositiondebatterie() === $this) {
                $velo->setPositiondebatterie(null);
            }
        }

        return $this;
    }
}
