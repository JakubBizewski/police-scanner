<?php

namespace PoliceScanner\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PoliceScanner\Repository\VehicleRepository")
 */
class Vehicle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="PoliceScanner\Entity\VehicleModel", inversedBy="vehicles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicleModel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vin;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $colour;

    /**
     * @ORM\Column(type="datetime")
     */
    private $productionYear;

    /**
     * @ORM\OneToOne(targetEntity="PoliceScanner\Entity\VehicleRegistration", mappedBy="vehicle", cascade={"persist", "remove"})
     */
    private $registration;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicleModel(): ?VehicleModel
    {
        return $this->vehicleModel;
    }

    public function setVehicleModel(?VehicleModel $vehicleModel): self
    {
        $this->vehicleModel = $vehicleModel;

        return $this;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(string $vin): self
    {
        $this->vin = $vin;

        return $this;
    }

    public function getColour(): ?string
    {
        return $this->colour;
    }

    public function setColour(string $colour): self
    {
        $this->colour = $colour;

        return $this;
    }

    public function getProductionYear(): ?\DateTimeInterface
    {
        return $this->productionYear;
    }

    public function setProductionYear(\DateTimeInterface $productionYear): self
    {
        $this->productionYear = $productionYear;

        return $this;
    }

    public function getRegistration(): ?VehicleRegistration
    {
        return $this->registration;
    }

    public function setRegistration(?VehicleRegistration $registration): self
    {
        $this->registration = $registration;

        return $this;
    }
}
