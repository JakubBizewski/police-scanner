<?php

namespace PoliceScanner\Service;

use PoliceScanner\Entity\VehicleModel;
use PoliceScanner\Model\VehicleModelModel;
use PoliceScanner\Model\VehicleModelSaveModel;
use PoliceScanner\Repository\VehicleBrandRepository;
use PoliceScanner\Repository\VehicleModelRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class VehicleModelService
{
    private $brandRepository;
    private $modelRepository;
    private $validator;

    public function __construct(
        VehicleModelRepository $modelRepository,
        VehicleBrandRepository $brandRepository,
        ValidatorInterface $validator)
    {
        $this->brandRepository = $brandRepository;
        $this->modelRepository = $modelRepository;
        $this->validator = $validator;
    }

    public function get(int $id): ServiceResponse
    {
        try {
            $model = $this->modelRepository->find($id);
            if ($model) {
                $model = VehicleModelModel::fromEntity($model);

                return new ServiceResponse(200, "", $model);
            }

            return new ServiceResponse(404, "Model $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function getAll(): ServiceResponse
    {
        try {
            $models = $this->modelRepository->findAll();

            $models = array_map(function (VehicleModel $model) {
                return VehicleModelModel::fromEntity($model);
            }, $models);

            return new ServiceResponse(200, "", $models);

        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function create(VehicleModelSaveModel $model): ServiceResponse
    {
        try {
            $errors = $this->validator->validate($model);
            if (count($errors) > 0)
                return new ServiceResponse(400, $errors[0]);

            $brand = $this->brandRepository->find($model->brandId);
            if (!$brand)
                return new ServiceResponse(404, "Brand $model->brandId not found");

            $vehicleModel = new VehicleModel();
            $vehicleModel->setName($model->name);
            $vehicleModel->setBrand($brand);
            $vehicleModel->setMass($model->mass);
            $vehicleModel->setPower($model->power);
            $vehicleModel->setTorque($model->torque);

            $this->modelRepository->save($vehicleModel);

            return new ServiceResponse(201);
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function update(VehicleModelSaveModel $model): ServiceResponse
    {
        try {
            if (is_null($model->id))
                return new ServiceResponse(400, "ID of Model not set");

            $errors = $this->validator->validate($model);
            if (count($errors) > 0)
                return new ServiceResponse(400, $errors[0]);

            $vehicleModel = $this->modelRepository->find($model->id);
            if ($vehicleModel) {
                $brand = $this->brandRepository->find($model->brandId);
                if (!$brand)
                    return new ServiceResponse(404, "Brand $model->brandId not found");

                $vehicleModel->setName($model->name);
                $vehicleModel->setBrand($brand);
                $vehicleModel->setMass($model->mass);
                $vehicleModel->setPower($model->power);
                $vehicleModel->setTorque($model->torque);

                $this->modelRepository->save($vehicleModel);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Model $model->id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function delete(int $id): ServiceResponse
    {
        try {
            $model = $this->modelRepository->find($id);
            if ($model) {
                $this->modelRepository->delete($model);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Model $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }
}
