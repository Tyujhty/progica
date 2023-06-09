<?php

namespace App\Entity;

use App\Repository\ShelterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShelterRepository::class)]
class Shelter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $surface = null;

    #[ORM\Column]
    private ?int $nbBedrooms = null;

    #[ORM\Column]
    private ?int $nbBeds = null;

    #[ORM\Column]
    private ?bool $acceptAnimals = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2, nullable: true)]
    private ?string $priceAnimals = null;

    #[ORM\ManyToOne(inversedBy: 'shelters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Price $price = null;

    #[ORM\ManyToOne(inversedBy: 'shelters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Manager $manager = null;

    #[ORM\ManyToOne(inversedBy: 'shelters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Owner $owner = null;

    #[ORM\ManyToOne(inversedBy: 'shelters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Town $town = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: InteriorEquipment::class, mappedBy: 'equipment')]
    private Collection $interiorEquipment;

    #[ORM\ManyToMany(targetEntity: ExteriorEquipment::class, mappedBy: 'equipment')]
    private Collection $exteriorEquipment;

    #[ORM\ManyToMany(targetEntity: Service::class, mappedBy: 'service')]
    private Collection $services;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'shelters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->interiorEquipment = new ArrayCollection();
        $this->exteriorEquipment = new ArrayCollection();
        $this->services = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getNbBedrooms(): ?int
    {
        return $this->nbBedrooms;
    }

    public function setNbBedrooms(int $nbBedrooms): self
    {
        $this->nbBedrooms = $nbBedrooms;

        return $this;
    }

    public function getNbBeds(): ?int
    {
        return $this->nbBeds;
    }

    public function setNbBeds(int $nbBeds): self
    {
        $this->nbBeds = $nbBeds;

        return $this;
    }

    public function isAcceptAnimals(): ?bool
    {
        return $this->acceptAnimals;
    }

    public function setAcceptAnimals(bool $acceptAnimals): self
    {
        $this->acceptAnimals = $acceptAnimals;

        return $this;
    }

    public function getPriceAnimals(): ?string
    {
        return $this->priceAnimals;
    }

    public function setPriceAnimals(string $priceAnimals): self
    {
        $this->priceAnimals = $priceAnimals;

        return $this;
    }

    public function getPrice(): ?Price
    {
        return $this->price;
    }

    public function setPrice(?Price $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getManager(): ?Manager
    {
        return $this->manager;
    }

    public function setManager(?Manager $manager): self
    {
        $this->manager = $manager;

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getTown(): ?Town
    {
        return $this->town;
    }

    public function setTown(?Town $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, InteriorEquipment>
     */
    public function getInteriorEquipment(): Collection
    {
        return $this->interiorEquipment;
    }

    public function addInteriorEquipment(InteriorEquipment $interiorEquipment): self
    {
        if (!$this->interiorEquipment->contains($interiorEquipment)) {
            $this->interiorEquipment->add($interiorEquipment);
            $interiorEquipment->addEquipment($this);
        }

        return $this;
    }

    public function removeInteriorEquipment(InteriorEquipment $interiorEquipment): self
    {
        if ($this->interiorEquipment->removeElement($interiorEquipment)) {
            $interiorEquipment->removeEquipment($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ExteriorEquipment>
     */
    public function getExteriorEquipment(): Collection
    {
        return $this->exteriorEquipment;
    }

    public function addExteriorEquipment(ExteriorEquipment $exteriorEquipment): self
    {
        if (!$this->exteriorEquipment->contains($exteriorEquipment)) {
            $this->exteriorEquipment->add($exteriorEquipment);
            $exteriorEquipment->addEquipment($this);
        }

        return $this;
    }

    public function removeExteriorEquipment(ExteriorEquipment $exteriorEquipment): self
    {
        if ($this->exteriorEquipment->removeElement($exteriorEquipment)) {
            $exteriorEquipment->removeEquipment($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
            $service->addService($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->removeElement($service)) {
            $service->removeService($this);
        }

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
