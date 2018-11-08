<?php

namespace PoliceScanner\Model;

use PoliceScanner\Entity\Citizen;
use PoliceScanner\Entity\Vehicle;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class VehicleModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     * @Assert\NotBlank()
     */
    public $modelId;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $vin;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $colour;

    /**
     * @var string
     * @Assert\DateTime(format="Y-m-d\TH:i:sP")
     * @Assert\NotBlank()
     */
    public $productionYear;

    public static function fromEntity(Vehicle $vehicle): self
    {
        $model = new self();
        $model->id = $vehicle->getId();
        $model->modelId = $vehicle->getVehicleModel()->getId();
        $model->vin = $vehicle->getVin();
        $model->colour = $vehicle->getColour();
        $model->productionYear = $vehicle->getProductionYear()->format(DATE_ATOM);

        return $model;
    }

    public static function fromRequest(Request $request): self
    {
        $data = json_decode($request->getContent());

        $model = new self();
        $model->id = isset($data->id) ? $data->id : null;
        $model->modelId = isset($data->modelId) ? $data->modelId : null;
        $model->vin = isset($data->vin) ? $data->vin : null;
        $model->colour = isset($data->colour) ? $data->colour : null;
        $model->productionYear = isset($data->productionYear) ? $data->productionYear : null;

        return $model;
    }
}
