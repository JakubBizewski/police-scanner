<?php

namespace PoliceScanner\Model;

use PoliceScanner\Entity\Citizen;
use PoliceScanner\Entity\Vehicle;
use PoliceScanner\Entity\VehicleRegistration;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class VehicleRegistrationModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     * @Assert\NotBlank()
     */
    public $vehicleId;

    /**
     * @var int
     * @Assert\NotBlank()
     */
    public $ownerId;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $number;

    /**
     * @var string
     * @Assert\DateTime(format="Y-m-d\TH:i:sP")
     * @Assert\NotBlank()
     */
    public $createTime;

    /**
     * @var string
     * @Assert\DateTime(format="Y-m-d\TH:i:sP")
     * @Assert\NotBlank()
     */
    public $expireTime;

    public static function fromEntity(VehicleRegistration $registration): self
    {
        $model = new self();
        $model->id = $registration->getId();
        $model->vehicleId = $registration->getVehicle()->getId();
        $model->ownerId = $registration->getOwner()->getId();
        $model->number = $registration->getNumber();
        $model->createTime = $registration->getCreateTime()->format(DATE_ATOM);
        $model->expireTime = $registration->getExpireTime()->format(DATE_ATOM);

        return $model;
    }

    public static function fromRequest(Request $request): self
    {
        $data = json_decode($request->getContent());

        $model = new self();
        $model->id = isset($data->id) ? $data->id : null;
        $model->vehicleId = isset($data->vehicleId) ? $data->vehicleId : null;
        $model->ownerId = isset($data->ownerId) ? $data->ownerId : null;
        $model->number = isset($data->number) ? $data->number : null;
        $model->createTime = isset($data->createTime) ? $data->createTime : null;
        $model->expireTime = isset($data->expireTime) ? $data->expireTime : null;

        return $model;
    }
}
