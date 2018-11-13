<?php

namespace PoliceScanner\Model;

use PoliceScanner\Entity\Vehicle;

class VehicleModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var VehicleModelSaveModel
     */
    public $model;

    /**
     * @var string
     */
    public $vin;

    /**
     * @var string
     */
    public $colour;

    /**
     * @var string
     */
    public $productionYear;

    public static function fromEntity(Vehicle $vehicle): self
    {
        $model = new self();
        $model->id = $vehicle->getId();
        $model->model = VehicleModelModel::fromEntity($vehicle->getVehicleModel());
        $model->vin = $vehicle->getVin();
        $model->colour = $vehicle->getColour();
        $model->productionYear = $vehicle->getProductionYear()->format(DATE_ATOM);

        return $model;
    }
}
