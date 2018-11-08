<?php

namespace PoliceScanner\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PoliceScanner\Repository\VehicleBrandRepository")
 */
class VehicleBrand
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
     * @ORM\OneToMany(targetEntity="PoliceScanner\Entity\Vehicle", mappedBy="brand")
     */
    private $vehicleModels;

    public function __construct()
    {
        $this->vehicleModels = new ArrayCollection();
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
     * @return Collection|VehicleModel[]
     */
    public function getVehicleModels(): Collection
    {
        return $this->vehicleModels;
    }

    public function addVehicleModel(VehicleModel $vehicleModel): self
    {
        if (!$this->vehicleModels->contains($vehicleModel)) {
            $this->vehicleModels[] = $vehicleModel;
            $vehicleModel->setBrand($this);
        }

        return $this;
    }

    public function removeVehicleModel(VehicleModel $vehicleModel): self
    {
        if ($this->vehicleModels->contains($vehicleModel)) {
            $this->vehicleModels->removeElement($vehicleModel);
            // set the owning side to null (unless already changed)
            if ($vehicleModel->getBrand() === $this) {
                $vehicleModel->setBrand(null);
            }
        }

        return $this;
    }
}
