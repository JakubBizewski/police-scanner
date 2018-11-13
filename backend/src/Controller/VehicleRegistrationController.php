<?php

namespace PoliceScanner\Controller;

use PoliceScanner\Model\VehicleModelSaveModel;
use PoliceScanner\Model\VehicleRegistrationSaveModel;
use PoliceScanner\Service\VehicleModelService;
use PoliceScanner\Service\VehicleRegistrationService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VehicleRegistrationController extends BaseController
{
    private $registrationService;

    public function __construct(VehicleRegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * @param int $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/registration/{id}", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function get($id)
    {
        $response = $this->registrationService->get($id);

        return $this->createResponse($response);
    }

    /**
     * @param string $number
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/registration/{number}", methods={"GET"})
     */
    public function getByNumber(string $number)
    {
        $response = $this->registrationService->getByRegistration($number);

        return $this->createResponse($response);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/registration", methods={"GET"})
     */
    public function getAll()
    {
        $response = $this->registrationService->getAll();

        return $this->createResponse($response);
    }

    /**
     * @param $request Request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/registration", methods={"POST"})
     */
    public function post(Request $request)
    {
        $model = VehicleRegistrationSaveModel::fromRequest($request);
        $response = $this->registrationService->create($model);

        return $this->createResponse($response);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/registration", methods={"PUT"})
     */
    public function put(Request $request)
    {
        $model = VehicleRegistrationSaveModel::fromRequest($request);
        $response = $this->registrationService->update($model);

        return $this->createResponse($response);
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/registration/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        $response = $this->registrationService->delete($id);

        return $this->createResponse($response);
    }
}
