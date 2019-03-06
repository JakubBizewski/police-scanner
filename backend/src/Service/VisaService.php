<?php

namespace PoliceScanner\Service;

use PoliceScanner\Entity\Visa;
use PoliceScanner\Model\VisaModel;
use PoliceScanner\Model\VisaSaveModel;
use PoliceScanner\Repository\CitizenRepository;
use PoliceScanner\Repository\VisaRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class VisaService
{
    private $visaRepository;
    private $citizenRepository;
    private $validator;

    public function __construct(
        VisaRepository $visaRepository,
        CitizenRepository $citizenRepository,
        ValidatorInterface $validator)
    {
        $this->visaRepository = $visaRepository;
        $this->citizenRepository = $citizenRepository;
        $this->validator = $validator;
    }

    public function get(int $id): ServiceResponse
    {
        try {
            $visa = $this->visaRepository->find($id);
            if ($visa) {
                $visa = VisaModel::fromEntity($visa);

                return new ServiceResponse(200, "", $visa);
            }

            return new ServiceResponse(404, "Visa $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function getByOwnerId(int $id): ServiceResponse
    {
        try {
            $citizen = $this->citizenRepository->find($id);
            if (!$citizen)
                return new ServiceResponse(404, "Citizen $id not found");

            $visa = $this->visaRepository->findByCitizen($citizen);
            if ($visa) {
                $model = VisaModel::fromEntity($visa);

                return new ServiceResponse(200, "", $model);
            }

            return new ServiceResponse(404, "Visa for citizen $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function getAll(): ServiceResponse
    {
        try {
            $models = $this->visaRepository->findAll();

            $models = array_map(function (Visa $visa) {
                return VisaModel::fromEntity($visa);
            }, $models);

            return new ServiceResponse(200, "", $models);

        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function create(VisaSaveModel $model): ServiceResponse
    {
        try {
            $errors = $this->validator->validate($model);
            if (count($errors) > 0)
                return new ServiceResponse(400, $errors[0]);

            $citizen = $this->citizenRepository->find($model->ownerId);
            if (!$citizen)
                return new ServiceResponse(404, "Citizen $model->ownerId not found");

            $visa = new Visa();
            $visa->setOwner($citizen);
            $visa->setCreateTime(new \DateTime($model->createTime));
            $visa->setExpireTime(new \DateTime($model->expireTime));

            $this->visaRepository->save($visa);

            return new ServiceResponse(201);
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function update(VisaSaveModel $model): ServiceResponse
    {
        try {
            if (is_null($model->id))
                return new ServiceResponse(400, "ID of Visa not set");

            $errors = $this->validator->validate($model);
            if (count($errors) > 0)
                return new ServiceResponse(400, $errors[0]);

            $visa = $this->visaRepository->find($model->id);
            if ($visa) {
                $citizen = $this->citizenRepository->find($model->ownerId);
                if (!$citizen)
                    return new ServiceResponse(404, "Citizen $model->ownerId not found");

                $visa->setOwner($citizen);
                $visa->setCreateTime(new \DateTime($model->createTime));
                $visa->setExpireTime(new \DateTime($model->expireTime));

                $this->visaRepository->save($visa);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Visa $model->id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function delete(int $id): ServiceResponse
    {
        try {
            $visa = $this->visaRepository->find($id);
            if ($visa) {
                $this->visaRepository->delete($visa);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Visa $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }
}
