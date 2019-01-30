<?php

namespace PoliceScanner\Model;

use PoliceScanner\Entity\VehicleInsurance;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class VehicleInsuranceSaveModel
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

    public static function fromEntity(VehicleInsurance $insurance): self
    {
        $model = new self();
        $model->id = $insurance->getId();
        $model->vehicleId = $insurance->getVehicle()->getId();
        $model->ownerId = $insurance->getOwner()->getId();
        $model->createTime = $insurance->getCreateTime()->format(DATE_ATOM);
        $model->expireTime = $insurance->getExpireTime()->format(DATE_ATOM);

        return $model;
    }

    public static function fromRequest(Request $request): self
    {
        $data = json_decode($request->getContent());

        $model = new self();
        $model->id = isset($data->id) ? $data->id : null;
        $model->vehicleId = isset($data->vehicleId) ? $data->vehicleId : null;
        $model->ownerId = isset($data->ownerId) ? $data->ownerId : null;
        $model->createTime = isset($data->createTime) ? $data->createTime : null;
        $model->expireTime = isset($data->expireTime) ? $data->expireTime : null;

        return $model;
    }
}
