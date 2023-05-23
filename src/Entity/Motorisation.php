<?php

namespace App\Entity;

use App\Repository\MotorisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MotorisationRepository::class)
 */
class Motorisation
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
    private $taille_motor;

    /**
     * @ORM\OneToMany(targetEntity=Velos::class, mappedBy="motor")
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

    public function getTailleMotor(): ?string
    {
        return $this->taille_motor;
    }

    public function setTailleMotor(string $taille_motor): self
    {
        $this->taille_motor = $taille_motor;

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
            $velo->setMotor($this);
        }

        return $this;
    }

    public function removeVelo(Velos $velo): self
    {
        if ($this->velos->removeElement($velo)) {
            // set the owning side to null (unless already changed)
            if ($velo->getMotor() === $this) {
                $velo->setMotor(null);
            }
        }

        return $this;
    }
}
