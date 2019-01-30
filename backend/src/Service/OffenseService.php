<?php

namespace PoliceScanner\Service;

use PoliceScanner\Entity\Offense;
use PoliceScanner\Model\OffenseModel;
use PoliceScanner\Repository\OffenseRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OffenseService
{
    private $offenseRepository;
    private $validator;

    public function __construct(OffenseRepository $repository, ValidatorInterface $validator)
    {
        $this->offenseRepository = $repository;
        $this->validator = $validator;
    }

    public function get(int $id): ServiceResponse
    {
        try {
            $offense = $this->offenseRepository->find($id);
            if ($offense) {
                $model = OffenseModel::fromEntity($offense);

                return new ServiceResponse(200, "", $model);
            }

            return new ServiceResponse(404, "Offense $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function getAll(): ServiceResponse
    {
        try {
            $offenses = $this->offenseRepository->findAll();

            $models = array_map(function (Offense $offense) {
                return OffenseModel::fromEntity($offense);
            }, $offenses);

            return new ServiceResponse(200, "", $models);

        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function create(OffenseModel $model): ServiceResponse
    {
        try {
            $errors = $this->validator->validate($model);
            if (count($errors) > 0) {
                return new ServiceResponse(400, $errors[0]);
            }

            $offense = new Offense();
            $offense->setName($model->name);
            $offense->setFine($model->fine);
            $offense->setIsFelony($model->isFelony);

            $this->offenseRepository->save($offense);

            return new ServiceResponse(201);
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function update(OffenseModel $model): ServiceResponse
    {
        try {
            if (is_null($model->id))
                return new ServiceResponse(400, "ID of Offense not set");

            $errors = $this->validator->validate($model);
            if (count($errors) > 0) {
                return new ServiceResponse(400, $errors[0]);
            }

            $offense = $this->offenseRepository->find($model->id);
            if ($offense) {
                $offense->setName($model->name);
                $offense->setFine($model->fine);
                $offense->setIsFelony($model->isFelony);

                $this->offenseRepository->save($offense);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Offense $model->id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function delete(int $id): ServiceResponse
    {
        try {
            $offense = $this->offenseRepository->find($id);
            if ($offense) {
                $this->offenseRepository->delete($offense);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Offense $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }
}
