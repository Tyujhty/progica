<?php

namespace App\Entity;

use App\Repository\OwnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OwnerRepository::class)]
class Owner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $firstName = null;

    #[ORM\Column(length: 50)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 20)]
    private ?string $phone = null;

    #[ORM\Column(length: 150)]
    private ?string $mail = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Shelter::class)]
    private Collection $shelters;

    public function __construct()
    {
        $this->shelters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
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
            $shelter->setOwner($this);
        }

        return $this;
    }

    public function removeShelter(Shelter $shelter): self
    {
        if ($this->shelters->removeElement($shelter)) {
            // set the owning side to null (unless already changed)
            if ($shelter->getOwner() === $this) {
                $shelter->setOwner(null);
            }
        }

        return $this;
    }
}
