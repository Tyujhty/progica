<?php

namespace App\Entity;

use App\Repository\ShelterRepository;
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
}