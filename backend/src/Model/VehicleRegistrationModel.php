<?php

namespace PoliceScanner\Model;

use PoliceScanner\Entity\VehicleRegistration;

class VehicleRegistrationModel
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
    public $number;

    /**
     * @var string
     */
    public $createTime;

    /**
     * @var string
     */
    public $expireTime;

    public static function fromEntity(VehicleRegistration $registration): self
    {
        $model = new self();
        $model->id = $registration->getId();
        $model->vehicle = VehicleModel::fromEntity($registration->getVehicle());
        $model->owner = CitizenModel::fromEntity($registration->getOwner());
        $model->number = $registration->getNumber();
        $model->createTime = $registration->getCreateTime()->format(DATE_ATOM);
        $model->expireTime = $registration->getExpireTime()->format(DATE_ATOM);

        return $model;
    }
}
