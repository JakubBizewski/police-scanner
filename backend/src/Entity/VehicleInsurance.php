<?php

namespace PoliceScanner\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PoliceScanner\Repository\VehicleInsuranceRepository")
 */
class VehicleInsurance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="PoliceScanner\Entity\Vehicle", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicle;

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
     * @ORM\Column(type="datetime")
     */
    private $expireTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

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
