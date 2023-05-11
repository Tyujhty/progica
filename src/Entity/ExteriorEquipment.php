<?php

namespace App\Entity;

use App\Repository\ExteriorEquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExteriorEquipmentRepository::class)]
class ExteriorEquipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Shelter::class, inversedBy: 'exteriorEquipment')]
    private Collection $price;

    public function __construct()
    {
        $this->price = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Shelter>
     */
    public function getPrice(): Collection
    {
        return $this->price;
    }

    public function addPrice(Shelter $price): self
    {
        if (!$this->price->contains($price)) {
            $this->price->add($price);
        }

        return $this;
    }

    public function removePrice(Shelter $price): self
    {
        $this->price->removeElement($price);

        return $this;
    }
}
