<?php

namespace PoliceScanner\Model;

use PoliceScanner\Entity\VehicleBrand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class VehicleBrandModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     * @Assert\NotBlank()
     */
    public $name;

    public static function fromEntity(VehicleBrand $brand): self
    {
        $model = new self();
        $model->id = $brand->getId();
        $model->name = $brand->getName();

        return $model;
    }

    public static function fromRequest(Request $request): self
    {
        $data = json_decode($request->getContent());

        $model = new self();
        $model->id = isset($data->id) ? $data->id : null;
        $model->name = isset($data->name) ? $data->name : null;

        return $model;
    }
}
