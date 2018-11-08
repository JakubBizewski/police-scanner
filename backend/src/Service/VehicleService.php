<?php

namespace PoliceScanner\Service;

use PoliceScanner\Entity\Vehicle;
use PoliceScanner\Model\VehicleModel;
use PoliceScanner\Repository\CitizenRepository;
use PoliceScanner\Repository\VehicleModelRepository;
use PoliceScanner\Repository\VehicleRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class VehicleService
{
    private $vehicleRepository;
    private $citizenRepository;
    private $vehicleModelRepository;
    private $validator;

    public function __construct(
        VehicleRepository $repository,
        CitizenRepository $citizenRepository,
        VehicleModelRepository $vehicleModelRepository,
        ValidatorInterface $validator)
    {
        $this->vehicleRepository = $repository;
        $this->citizenRepository = $citizenRepository;
        $this->vehicleModelRepository = $vehicleModelRepository;
        $this->validator = $validator;
    }

    public function get(int $id): ServiceResponse
    {
        try {
            $vehicle = $this->vehicleRepository->find($id);
            if ($vehicle) {
                $model = VehicleModel::fromEntity($vehicle);

                return new ServiceResponse(200, "", $model);
            }

            return new ServiceResponse(404, "Vehicle $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function getByVin(string $vin): ServiceResponse
    {
        try {
            $vehicle = $this->vehicleRepository->findByVin($vin);
            if ($vehicle) {
                $model = VehicleModel::fromEntity($vehicle);

                return new ServiceResponse(200, "", $model);
            }

            return new ServiceResponse(404, "Vehicle $vin not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function getAll(): ServiceResponse
    {
        try {
            $citizens = $this->vehicleRepository->findAll();

            $models = array_map(function (Vehicle $vehicle) {
                return VehicleModel::fromEntity($vehicle);
            }, $citizens);

            return new ServiceResponse(200, "", $models);

        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function create(VehicleModel $model): ServiceResponse
    {
        try {
            $errors = $this->validator->validate($model);
            if (count($errors) > 0)
                return new ServiceResponse(400, $errors[0]);

            $vehicleModel = $this->vehicleModelRepository->find($model->modelId);
            if (!$vehicleModel)
                return new ServiceResponse(404, "VehicleModel not found");

            $vehicle = new Vehicle();
            $vehicle->setVehicleModel($vehicleModel);
            $vehicle->setVin($model->vin);
            $vehicle->setColour($model->colour);
            $vehicle->setProductionYear(new \DateTime($model->productionYear));

            $this->vehicleRepository->save($vehicle);

            return new ServiceResponse(201);
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function update(VehicleModel $model): ServiceResponse
    {
        try {
            if (is_null($model->id))
                return new ServiceResponse(400, "ID of Vehicle not set");

            $errors = $this->validator->validate($model);
            if (count($errors) > 0)
                return new ServiceResponse(400, $errors[0]);

            $vehicle = $this->vehicleRepository->find($model->id);
            if ($vehicle) {
                $vehicleModel = $this->vehicleModelRepository->find($model->modelId);
                if (!$vehicleModel)
                    return new ServiceResponse(404, "VehicleModel $model->modelId not found");

                $vehicle->setVehicleModel($vehicleModel);
                $vehicle->setVin($model->vin);
                $vehicle->setColour($model->colour);
                $vehicle->setProductionYear(new \DateTime($model->productionYear));

                $this->vehicleRepository->save($vehicle);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Vehicle $model->id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function delete(int $id): ServiceResponse
    {
        try {
            $vehicle = $this->vehicleRepository->find($id);
            if ($vehicle) {
                $this->vehicleRepository->delete($vehicle);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Vehicle $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }
}
