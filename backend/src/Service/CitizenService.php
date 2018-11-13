<?php

namespace PoliceScanner\Service;

use PoliceScanner\Entity\Citizen;
use PoliceScanner\Model\CitizenModel;
use PoliceScanner\Model\VehicleBrandSaveModel;
use PoliceScanner\Repository\CitizenRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CitizenService
{
    private $citizenRepository;
    private $validator;

    public function __construct(CitizenRepository $repository, ValidatorInterface $validator)
    {
        $this->citizenRepository = $repository;
        $this->validator = $validator;
    }

    public function get(int $id): ServiceResponse
    {
        try {
            $citizen = $this->citizenRepository->find($id);
            if ($citizen) {
                $model = CitizenModel::fromEntity($citizen);

                return new ServiceResponse(200, "", $model);
            }

            return new ServiceResponse(404, "Citizen $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function getAll(): ServiceResponse
    {
        try {
            $citizens = $this->citizenRepository->findAll();

            $models = array_map(function (Citizen $citizen) {
                return CitizenModel::fromEntity($citizen);
            }, $citizens);

            return new ServiceResponse(200, "", $models);

        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function create(CitizenModel $model): ServiceResponse
    {
        try {
            $errors = $this->validator->validate($model);
            if (count($errors) > 0) {
                return new ServiceResponse(400, $errors[0]);
            }

            $citizen = new Citizen();
            $citizen->setFirstName($model->firstName);
            $citizen->setLastName($model->lastName);
            $citizen->setDateOfBirth(new \DateTime($model->dateOfBirth));

            $this->citizenRepository->save($citizen);

            return new ServiceResponse(201);
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function update(CitizenModel $model): ServiceResponse
    {
        try {
            if (is_null($model->id))
                return new ServiceResponse(400, "ID of Citizen not set");

            $errors = $this->validator->validate($model);
            if (count($errors) > 0) {
                return new ServiceResponse(400, $errors[0]);
            }

            $citizen = $this->citizenRepository->find($model->id);
            if ($citizen) {
                $citizen->setFirstName($model->firstName);
                $citizen->setLastName($model->lastName);
                $citizen->setDateOfBirth(new \DateTime($model->dateOfBirth));

                $this->citizenRepository->save($citizen);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Citizen $model->id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function delete(int $id): ServiceResponse
    {
        try {
            $citizen = $this->citizenRepository->find($id);
            if ($citizen) {
                $this->citizenRepository->delete($citizen);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Citizen $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }
}
