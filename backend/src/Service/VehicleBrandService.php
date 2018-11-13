<?php

namespace PoliceScanner\Service;

use PoliceScanner\Entity\VehicleBrand;
use PoliceScanner\Model\VehicleBrandModel;
use PoliceScanner\Repository\VehicleBrandRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class VehicleBrandService
{
    private $brandRepository;
    private $validator;

    public function __construct(VehicleBrandRepository $repository, ValidatorInterface $validator)
    {
        $this->brandRepository = $repository;
        $this->validator = $validator;
    }

    public function get(int $id): ServiceResponse
    {
        try {
            $brand = $this->brandRepository->find($id);
            if ($brand) {
                $model = VehicleBrandModel::fromEntity($brand);

                return new ServiceResponse(200, "", $model);
            }

            return new ServiceResponse(404, "Brand $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function getAll(): ServiceResponse
    {
        try {
            $brands = $this->brandRepository->findAll();

            $models = array_map(function (VehicleBrand $brand) {
                return VehicleBrandModel::fromEntity($brand);
            }, $brands);

            return new ServiceResponse(200, "", $models);

        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function create(VehicleBrandModel $model): ServiceResponse
    {
        try {
            $errors = $this->validator->validate($model);
            if (count($errors) > 0) {
                return new ServiceResponse(400, $errors[0]);
            }

            $brand = new VehicleBrand();
            $brand->setName($model->name);

            $this->brandRepository->save($brand);

            return new ServiceResponse(201);
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function update(VehicleBrandModel $model): ServiceResponse
    {
        try {
            if (is_null($model->id))
                return new ServiceResponse(400, "ID of Brand not set");

            $errors = $this->validator->validate($model);
            if (count($errors) > 0) {
                return new ServiceResponse(400, $errors[0]);
            }

            $brand = $this->brandRepository->find($model->id);
            if ($brand) {
                $brand->setName($model->name);

                $this->brandRepository->save($brand);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Brand $model->id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function delete(int $id): ServiceResponse
    {
        try {
            $brand = $this->brandRepository->find($id);
            if ($brand) {
                $this->brandRepository->delete($brand);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Brand $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }
}
