<?php

namespace App\Entity;

use App\Repository\TaillederoueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaillederoueRepository::class)
 */
class Taillederoue
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
    private $taille_roue;

    /**
     * @ORM\OneToMany(targetEntity=Velos::class, mappedBy="roues")
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

    public function getTailleRoue(): ?string
    {
        return $this->taille_roue;
    }

    public function setTailleRoue(string $taille_roue): self
    {
        $this->taille_roue = $taille_roue;

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
            $velo->setRoues($this);
        }

        return $this;
    }

    public function removeVelo(Velos $velo): self
    {
        if ($this->velos->removeElement($velo)) {
            // set the owning side to null (unless already changed)
            if ($velo->getRoues() === $this) {
                $velo->setRoues(null);
            }
        }

        return $this;
    }
}
