<?php

namespace PoliceScanner\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PoliceScanner\Repository\VehicleRegistrationRepository")
 */
class VehicleRegistration
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="PoliceScanner\Entity\Citizen")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createTime;

    /**
     * @ORM\OneToOne(targetEntity="PoliceScanner\Entity\Vehicle", inversedBy="registration")
     */
    private $vehicle;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expireTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getOwner(): ?Citizen
    {
        return $this->owner;
    }

    public function setOwner(?Citizen $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getCreateTime(): ?\DateTimeInterface
    {
        return $this->createTime;
    }

    public function setCreateTime(\DateTimeInterface $createTime): self
    {
        $this->createTime = $createTime;

        return $this;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        // set (or unset) the owning side of the relation if necessary
        $newRegistration = $vehicle === null ? null : $this;
        if ($newRegistration !== $vehicle->getRegistration()) {
            $vehicle->setRegistration($newRegistration);
        }

        return $this;
    }

    public function getExpireTime(): ?\DateTimeInterface
    {
        return $this->expireTime;
    }

    public function setExpireTime(\DateTimeInterface $expireTime): self
    {
        $this->expireTime = $expireTime;

        return $this;
    }
}
