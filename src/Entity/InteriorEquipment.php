<?php

namespace App\Entity;

use App\Repository\InteriorEquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InteriorEquipmentRepository::class)]
class InteriorEquipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Shelter::class, inversedBy: 'interiorEquipment')]
    private Collection $equipment;

    public function __construct()
    {
        $this->equipment = new ArrayCollection();
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
    public function getEquipment(): Collection
    {
        return $this->equipment;
    }

    public function addEquipment(Shelter $equipment): self
    {
        if (!$this->equipment->contains($equipment)) {
            $this->equipment->add($equipment);
        }

        return $this;
    }

    public function removeEquipment(Shelter $equipment): self
    {
        $this->equipment->removeElement($equipment);

        return $this;
    }
}
