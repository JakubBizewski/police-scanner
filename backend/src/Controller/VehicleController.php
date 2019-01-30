<?php

namespace PoliceScanner\Controller;

use PoliceScanner\Model\VehicleSaveModel;
use PoliceScanner\Service\VehicleInsuranceService;
use PoliceScanner\Service\VehicleRegistrationService;
use PoliceScanner\Service\VehicleService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VehicleController extends BaseController
{
    private $vehicleService;
    private $registrationService;
    private $insuranceService;

    public function __construct(
        VehicleService $vehicleService,
        VehicleRegistrationService $registrationService,
        VehicleInsuranceService $insuranceService)
    {
        $this->vehicleService = $vehicleService;
        $this->registrationService = $registrationService;
        $this->insuranceService = $insuranceService;
    }

    /**
     * @param int $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/vehicle/{id}", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function get($id)
    {
        $response = $this->vehicleService->get($id);

        return $this->createResponse($response);
    }

    /**
     * @param string $vin
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/vehicle/{vin}", methods={"GET"})
     */
    public function getByVin(string $vin)
    {
        $response = $this->vehicleService->getByVin($vin);

        return $this->createResponse($response);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/vehicle", methods={"GET"})
     */
    public function getAll()
    {
        $response = $this->vehicleService->getAll();

        return $this->createResponse($response);
    }

    /**
     * @param int $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/vehicle/{id}/registration", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function getRegistration($id)
    {
        $response = $this->registrationService->getByVehicleId($id);

        return $this->createResponse($response);
    }

    /**
     * @param int $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/vehicle/{id}/insurance", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function getInsurance($id)
    {
        $response = $this->insuranceService->getByVehicleId($id);

        return $this->createResponse($response);
    }

    /**
     * @param $request Request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/vehicle", methods={"POST"})
     */
    public function post(Request $request)
    {
        $model = VehicleSaveModel::fromRequest($request);
        $response = $this->vehicleService->create($model);

        return $this->createResponse($response);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/vehicle", methods={"PUT"})
     */
    public function put(Request $request)
    {
        $model = VehicleSaveModel::fromRequest($request);
        $response = $this->vehicleService->update($model);

        return $this->createResponse($response);
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/vehicle/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        $response = $this->vehicleService->delete($id);

        return $this->createResponse($response);
    }
}
