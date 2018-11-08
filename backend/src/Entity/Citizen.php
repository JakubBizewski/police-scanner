<?php

namespace PoliceScanner\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PoliceScanner\Repository\CitizenRepository")
 */
class Citizen
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lastName;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfBirth;

    /**
     * @ORM\OneToMany(targetEntity="PoliceScanner\Entity\Citation", mappedBy="citizen", orphanRemoval=true)
     */
    private $citations;

    /**
     * @ORM\OneToMany(targetEntity="PoliceScanner\Entity\Vehicle", mappedBy="owner")
     */
    private $vehicles;

    public function __construct()
    {
        $this->citations = new ArrayCollection();
        $this->vehicles = new ArrayCollection();
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

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * @return Collection|Citation[]
     */
    public function getCitations(): Collection
    {
        return $this->citations;
    }

    public function addCitation(Citation $citation): self
    {
        if (!$this->citations->contains($citation)) {
            $this->citations[] = $citation;
            $citation->setCitizen($this);
        }

        return $this;
    }

    public function removeCitation(Citation $citation): self
    {
        if ($this->citations->contains($citation)) {
            $this->citations->removeElement($citation);
            // set the owning side to null (unless already changed)
            if ($citation->getCitizen() === $this) {
                $citation->setCitizen(null);
            }
        }

        return $this;
    }
}
