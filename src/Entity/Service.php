<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Shelter::class, inversedBy: 'services')]
    private Collection $service;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $icones = null;

    public function __construct()
    {
        $this->service = new ArrayCollection();
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

    /**
     * @return Collection<int, Shelter>
     */
    public function getService(): Collection
    {
        return $this->service;
    }

    public function addService(Shelter $service): self
    {
        if (!$this->service->contains($service)) {
            $this->service->add($service);
        }

        return $this;
    }

    public function removeService(Shelter $service): self
    {
        $this->service->removeElement($service);

        return $this;
    }

    public function getIcones(): ?string
    {
        return $this->icones;
    }

    public function setIcones(?string $icones): self
    {
        $this->icones = $icones;

        return $this;
    }
}
