<?php

namespace PoliceScanner\Model;

use PoliceScanner\Entity\VehicleInsurance;

class VehicleInsuranceModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var VehicleModel
     */
    public $vehicle;

    /**
     * @var CitizenModel
     */
    public $owner;

    /**
     * @var string
     */
    public $createTime;

    /**
     * @var string
     */
    public $expireTime;

    public static function fromEntity(VehicleInsurance $insurance): self
    {
        $model = new self();
        $model->id = $insurance->getId();
        $model->vehicle = VehicleModel::fromEntity($insurance->getVehicle());
        $model->owner = CitizenModel::fromEntity($insurance->getOwner());
        $model->createTime = $insurance->getCreateTime()->format(DATE_ATOM);
        $model->expireTime = $insurance->getExpireTime()->format(DATE_ATOM);

        return $model;
    }
}
