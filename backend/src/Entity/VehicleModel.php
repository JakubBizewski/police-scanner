<?php

namespace PoliceScanner\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PoliceScanner\Repository\VehicleModelRepository")
 */
class VehicleModel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="PoliceScanner\Entity\VehicleBrand", inversedBy="vehicleModels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\OneToMany(targetEntity="PoliceScanner\Entity\Vehicle", mappedBy="vehicleModel")
     */
    private $vehicles;

    /**
     * @ORM\Column(type="integer")
     */
    private $mass;

    /**
     * @ORM\Column(type="integer")
     */
    private $power;

    /**
     * @ORM\Column(type="integer")
     */
    private $torque;

    public function __construct()
    {
        $this->vehicles = new ArrayCollection();
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

    public function getBrand(): ?VehicleBrand
    {
        return $this->brand;
    }

    public function setBrand(?VehicleBrand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection|Vehicle[]
     */
    public function getVehicles(): Collection
    {
        return $this->vehicles;
    }

    public function addVehicle(Vehicle $vehicle): self
    {
        if (!$this->vehicles->contains($vehicle)) {
            $this->vehicles[] = $vehicle;
            $vehicle->setVehicleModel($this);
        }

        return $this;
    }

    public function removeVehicle(Vehicle $vehicle): self
    {
        if ($this->vehicles->contains($vehicle)) {
            $this->vehicles->removeElement($vehicle);
            // set the owning side to null (unless already changed)
            if ($vehicle->getVehicleModel() === $this) {
                $vehicle->setVehicleModel(null);
            }
        }

        return $this;
    }

    public function getMass(): ?int
    {
        return $this->mass;
    }

    public function setMass(int $mass): self
    {
        $this->mass = $mass;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getTorque(): ?int
    {
        return $this->torque;
    }

    public function setTorque(int $torque): self
    {
        $this->torque = $torque;

        return $this;
    }
}
