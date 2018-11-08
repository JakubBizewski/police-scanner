<?php

namespace PoliceScanner\Model;

use PoliceScanner\Entity\VehicleModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class VehicleModelModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @var int
     * @Assert\NotBlank()
     */
    public $brandId;

    /**
     * @var int
     * @Assert\NotBlank()
     */
    public $mass;

    /**
     * @var int
     * @Assert\NotBlank()
     */
    public $power;

    /**
     * @var int
     * @Assert\NotBlank()
     */
    public $torque;

    public static function fromEntity(VehicleModel $vehicle): self
    {
        $model = new self();
        $model->id = $vehicle->getId();
        $model->name = $vehicle->getName();
        $model->brandId = $vehicle->getBrand()->getId();
        $model->mass = $vehicle->getMass();
        $model->power = $vehicle->getPower();
        $model->torque = $vehicle->getTorque();

        return $model;
    }

    public static function fromRequest(Request $request): self
    {
        $data = json_decode($request->getContent());

        $model = new self();
        $model->id = isset($data->id) ? $data->id : null;
        $model->name = isset($data->name) ? $data->name : null;
        $model->brandId = isset($data->brandId) ? $data->brandId : null;
        $model->mass = isset($data->mass) ? $data->mass : null;
        $model->power = isset($data->power) ? $data->power : null;
        $model->torque = isset($data->torque) ? $data->torque : null;

        return $model;
    }
}
