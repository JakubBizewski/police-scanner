<?php

namespace PoliceScanner\Service;

use PoliceScanner\Entity\VehicleInsurance;
use PoliceScanner\Model\VehicleInsuranceModel;
use PoliceScanner\Model\VehicleInsuranceSaveModel;
use PoliceScanner\Repository\CitizenRepository;
use PoliceScanner\Repository\VehicleInsuranceRepository;
use PoliceScanner\Repository\VehicleRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class VehicleInsuranceService
{
    private $vehicleRepository;
    private $citizenRepository;
    private $insuranceRepository;
    private $validator;

    public function __construct(
        VehicleRepository $vehicleRepository,
        CitizenRepository $citizenRepository,
        VehicleInsuranceRepository $insuranceRepository,
        ValidatorInterface $validator)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->citizenRepository = $citizenRepository;
        $this->insuranceRepository = $insuranceRepository;
        $this->validator = $validator;
    }

    public function get(int $id): ServiceResponse
    {
        try {
            $insurance = $this->insuranceRepository->find($id);
            if ($insurance) {
                $insurance = VehicleInsuranceModel::fromEntity($insurance);

                return new ServiceResponse(200, "", $insurance);
            }

            return new ServiceResponse(404, "Insurance $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function getByVehicleId(int $id): ServiceResponse
    {
        try {
            $vehicle = $this->vehicleRepository->find($id);
            if (!$vehicle)
                return new ServiceResponse(404, "Vehicle $id not found");

            $insurance = $this->insuranceRepository->findByVehicle($vehicle);
            if ($insurance) {
                $model = VehicleInsuranceModel::fromEntity($insurance);

                return new ServiceResponse(200, "", $model);
            }

            return new ServiceResponse(404, "Insurance for vehicle $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function getAll(): ServiceResponse
    {
        try {
            $models = $this->insuranceRepository->findAll();

            $models = array_map(function (VehicleInsurance $insurance) {
                return VehicleInsuranceModel::fromEntity($insurance);
            }, $models);

            return new ServiceResponse(200, "", $models);

        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function create(VehicleInsuranceSaveModel $model): ServiceResponse
    {
        try {
            $errors = $this->validator->validate($model);
            if (count($errors) > 0)
                return new ServiceResponse(400, $errors[0]);

            $vehicle = $this->vehicleRepository->find($model->vehicleId);
            if (!$vehicle)
                return new ServiceResponse(404, "Vehicle $model->vehicleId not found");

            $citizen = $this->citizenRepository->find($model->ownerId);
            if (!$citizen)
                return new ServiceResponse(404, "Citizen $model->ownerId not found");

            $insurance = new VehicleInsurance();
            $insurance->setOwner($citizen);
            $insurance->setVehicle($vehicle);
            $insurance->setCreateTime(new \DateTime($model->createTime));
            $insurance->setExpireTime(new \DateTime($model->expireTime));

            $this->insuranceRepository->save($insurance);

            return new ServiceResponse(201);
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function update(VehicleInsuranceSaveModel $model): ServiceResponse
    {
        try {
            if (is_null($model->id))
                return new ServiceResponse(400, "ID of Insurance not set");

            $errors = $this->validator->validate($model);
            if (count($errors) > 0)
                return new ServiceResponse(400, $errors[0]);

            $insurance = $this->insuranceRepository->find($model->id);
            if ($insurance) {
                $vehicle = $this->vehicleRepository->find($model->vehicleId);
                if (!$vehicle)
                    return new ServiceResponse(404, "Vehicle $model->vehicleId not found");

                $citizen = $this->citizenRepository->find($model->ownerId);
                if (!$citizen)
                    return new ServiceResponse(404, "Citizen $model->ownerId not found");

                $insurance->setOwner($citizen);
                $insurance->setVehicle($vehicle);
                $insurance->setCreateTime(new \DateTime($model->createTime));
                $insurance->setExpireTime(new \DateTime($model->expireTime));

                $this->insuranceRepository->save($insurance);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Registration $model->id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function delete(int $id): ServiceResponse
    {
        try {
            $insurance = $this->insuranceRepository->find($id);
            if ($insurance) {
                $this->insuranceRepository->delete($insurance);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Insurance $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }
}
