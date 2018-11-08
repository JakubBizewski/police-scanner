<?php

namespace PoliceScanner\Service;

use PoliceScanner\Entity\VehicleModel;
use PoliceScanner\Entity\VehicleRegistration;
use PoliceScanner\Model\VehicleModelModel;
use PoliceScanner\Model\VehicleRegistrationModel;
use PoliceScanner\Repository\CitizenRepository;
use PoliceScanner\Repository\VehicleBrandRepository;
use PoliceScanner\Repository\VehicleModelRepository;
use PoliceScanner\Repository\VehicleRegistrationRepository;
use PoliceScanner\Repository\VehicleRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class VehicleRegistrationService
{
    private $vehicleRepository;
    private $citizenRepository;
    private $registrationRepository;
    private $validator;

    public function __construct(
        VehicleRepository $vehicleRepository,
        CitizenRepository $citizenRepository,
        VehicleRegistrationRepository $registrationRepository,
        ValidatorInterface $validator)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->citizenRepository = $citizenRepository;
        $this->registrationRepository = $registrationRepository;
        $this->validator = $validator;
    }

    public function get(int $id): ServiceResponse
    {
        try {
            $model = $this->registrationRepository->find($id);
            if ($model) {
                $model = VehicleRegistrationModel::fromEntity($model);

                return new ServiceResponse(200, "", $model);
            }

            return new ServiceResponse(404, "Registration $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function getByRegistration(string $number): ServiceResponse
    {
        try {
            $registration = $this->registrationRepository->findByRegistration($number);
            if ($registration) {
                $model = VehicleRegistrationModel::fromEntity($registration);

                return new ServiceResponse(200, "", $model);
            }

            return new ServiceResponse(404, "Registration $number not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function getAll(): ServiceResponse
    {
        try {
            $models = $this->registrationRepository->findAll();

            $models = array_map(function (VehicleRegistration $registration) {
                return VehicleRegistrationModel::fromEntity($registration);
            }, $models);

            return new ServiceResponse(200, "", $models);

        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function create(VehicleRegistrationModel $model): ServiceResponse
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

            $registration = new VehicleRegistration();
            $registration->setNumber($model->number);
            $registration->setOwner($citizen);
            $registration->setVehicle($vehicle);
            $registration->setCreateTime(new \DateTime($model->createTime));
            $registration->setExpireTime(new \DateTime($model->expireTime));

            $this->registrationRepository->save($registration);

            return new ServiceResponse(201);
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function update(VehicleRegistrationModel $model): ServiceResponse
    {
        try {
            if (is_null($model->id))
                return new ServiceResponse(400, "ID of Registration not set");

            $errors = $this->validator->validate($model);
            if (count($errors) > 0)
                return new ServiceResponse(400, $errors[0]);

            $registration = $this->registrationRepository->find($model->id);
            if ($registration) {
                $vehicle = $this->vehicleRepository->find($model->vehicleId);
                if (!$vehicle)
                    return new ServiceResponse(404, "Vehicle $model->vehicleId not found");

                $citizen = $this->citizenRepository->find($model->ownerId);
                if (!$citizen)
                    return new ServiceResponse(404, "Citizen $model->ownerId not found");

                $registration->setNumber($model->number);
                $registration->setOwner($citizen);
                $registration->setVehicle($vehicle);
                $registration->setCreateTime(new \DateTime($model->createTime));
                $registration->setExpireTime(new \DateTime($model->expireTime));

                $this->registrationRepository->save($registration);

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
            $registration = $this->registrationRepository->find($id);
            if ($registration) {
                $this->registrationRepository->delete($registration);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Registration $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }
}
