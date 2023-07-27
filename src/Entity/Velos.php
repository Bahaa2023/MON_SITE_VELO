<?php

namespace App\Entity;

use App\Repository\VelosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=VelosRepository::class)
 * @Vich\Uploadable
 */
class Velos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="velos")
     */
    private $categorie;


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="velos", fileNameProperty="imageName")
     */
    private ?File $imageFile;

    /**
     * @ORM\Column(nullable="true")
     */
    private ?string $imageName = null;

    /**
     * @ORM\ManyToOne(targetEntity=Taillederoue::class, inversedBy="velos")
     */
    private $roues;

    /**
     * @ORM\ManyToOne(targetEntity=Capacitebatterie::class, inversedBy="velos")
     */
    private $capacitebatterie;

    /**
     * @ORM\ManyToOne(targetEntity=Motorisation::class, inversedBy="velos")
     */
    private $motor;

    /**
     * @ORM\ManyToOne(targetEntity=Nombredevitesse::class, inversedBy="velos")
     */
    private $vitesse;

    /**
     * @ORM\ManyToOne(targetEntity=Positiondebatterie::class, inversedBy="velos")
     */
    private $positiondebatterie;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Detailcommande::class, mappedBy="velo")
     */
    private $detailcommandes;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    public function __construct()
    {

        $this->detailcommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getRoues(): ?taillederoue
    {
        return $this->roues;
    }

    public function setRoues(?taillederoue $roues): self
    {
        $this->roues = $roues;

        return $this;
    }

    public function getcapacitebatterie(): ?capacitebatterie
    {
        return $this->capacitebatterie;
    }

    public function setcapacitebatterie(?capacitebatterie $capacitebatterie): self
    {
        $this->capacitebatterie = $capacitebatterie;

        return $this;
    }

    public function getMotor(): ?motorisation
    {
        return $this->motor;
    }

    public function setMotor(?motorisation $motor): self
    {
        $this->motor = $motor;

        return $this;
    }

    public function getVitesse(): ?nombredevitesse
    {
        return $this->vitesse;
    }

    public function setVitesse(?nombredevitesse $vitesse): self
    {
        $this->vitesse = $vitesse;

        return $this;
    }

    public function getPositiondebatterie(): ?positiondebatterie
    {
        return $this->positiondebatterie;
    }

    public function setPositiondebatterie(?positiondebatterie $positiondebatterie): self
    {
        $this->positiondebatterie = $positiondebatterie;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Detailcommande>
     */
    public function getDetailcommandes(): Collection
    {
        return $this->detailcommandes;
    }

    public function addDetailcommande(Detailcommande $detailcommande): self
    {
        if (!$this->detailcommandes->contains($detailcommande)) {
            $this->detailcommandes[] = $detailcommande;
            $detailcommande->setVelo($this);
        }

        return $this;
    }

    public function removeDetailcommande(Detailcommande $detailcommande): self
    {
        if ($this->detailcommandes->removeElement($detailcommande)) {
            // set the owning side to null (unless already changed)
            if ($detailcommande->getVelo() === $this) {
                $detailcommande->setVelo(null);
            }
        }

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }
}
