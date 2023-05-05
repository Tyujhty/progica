<?php

namespace App\Entity;

use App\Repository\TownRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TownRepository::class)]
class Town
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'towns')]
    private ?Department $department = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'town', targetEntity: Shelter::class)]
    private Collection $shelters;

    public function __construct()
    {
        $this->shelters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
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

    public function __toString() {
        return $this->name;
    }

    /**
     * @return Collection<int, Shelter>
     */
    public function getShelters(): Collection
    {
        return $this->shelters;
    }

    public function addShelter(Shelter $shelter): self
    {
        if (!$this->shelters->contains($shelter)) {
            $this->shelters->add($shelter);
            $shelter->setTown($this);
        }

        return $this;
    }

    public function removeShelter(Shelter $shelter): self
    {
        if ($this->shelters->removeElement($shelter)) {
            // set the owning side to null (unless already changed)
            if ($shelter->getTown() === $this) {
                $shelter->setTown(null);
            }
        }

        return $this;
    }
}
