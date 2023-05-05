<?php

namespace App\Entity;

use App\Repository\PriceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PriceRepository::class)]
class Price
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $beginning = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $end = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2)]
    private ?string $price = null;

    #[ORM\OneToMany(mappedBy: 'price', targetEntity: Shelter::class)]
    private Collection $shelters;

    public function __construct()
    {
        $this->shelters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeginning(): ?\DateTimeInterface
    {
        return $this->beginning;
    }

    public function setBeginning(\DateTimeInterface $beginning): self
    {
        $this->beginning = $beginning;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
    public function __toString() {
        return $this->price;
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
            $shelter->setPrice($this);
        }

        return $this;
    }

    public function removeShelter(Shelter $shelter): self
    {
        if ($this->shelters->removeElement($shelter)) {
            // set the owning side to null (unless already changed)
            if ($shelter->getPrice() === $this) {
                $shelter->setPrice(null);
            }
        }

        return $this;
    }


}
