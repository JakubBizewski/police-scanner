<?php

namespace PoliceScanner\Model;

use PoliceScanner\Entity\VehicleModel;

class VehicleModelModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var VehicleBrandModel
     */
    public $brand;

    /**
     * @var int
     */
    public $mass;

    /**
     * @var int
     */
    public $power;

    /**
     * @var int
     */
    public $torque;

    public static function fromEntity(VehicleModel $vehicle): self
    {
        $model = new self();
        $model->id = $vehicle->getId();
        $model->name = $vehicle->getName();
        $model->brand = VehicleBrandModel::fromEntity($vehicle->getBrand());
        $model->mass = $vehicle->getMass();
        $model->power = $vehicle->getPower();
        $model->torque = $vehicle->getTorque();

        return $model;
    }
}
