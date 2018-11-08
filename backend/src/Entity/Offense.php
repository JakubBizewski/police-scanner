<?php

namespace PoliceScanner\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PoliceScanner\Repository\OffenseRepository")
 */
class Offense
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
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $fine;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFelony;

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

    public function getFine(): ?int
    {
        return $this->fine;
    }

    public function setFine(int $fine): self
    {
        $this->fine = $fine;

        return $this;
    }

    public function getIsFelony(): ?bool
    {
        return $this->isFelony;
    }

    public function setIsFelony(bool $isFelony): self
    {
        $this->isFelony = $isFelony;

        return $this;
    }
}
