<?php

namespace PoliceScanner\Controller;

use PoliceScanner\Model\VehicleInsuranceSaveModel;
use PoliceScanner\Service\VehicleInsuranceService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VehicleInsuranceController extends BaseController
{
    private $insuranceService;

    public function __construct(VehicleInsuranceService $insuranceService)
    {
        $this->insuranceService = $insuranceService;
    }

    /**
     * @param int $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/insurance/{id}", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function get($id)
    {
        $response = $this->insuranceService->get($id);

        return $this->createResponse($response);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/insurance", methods={"GET"})
     */
    public function getAll()
    {
        $response = $this->insuranceService->getAll();

        return $this->createResponse($response);
    }

    /**
     * @param $request Request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/insurance", methods={"POST"})
     */
    public function post(Request $request)
    {
        $model = VehicleInsuranceSaveModel::fromRequest($request);
        $response = $this->insuranceService->create($model);

        return $this->createResponse($response);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/insurance", methods={"PUT"})
     */
    public function put(Request $request)
    {
        $model = VehicleInsuranceSaveModel::fromRequest($request);
        $response = $this->insuranceService->update($model);

        return $this->createResponse($response);
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/insurance/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        $response = $this->insuranceService->delete($id);

        return $this->createResponse($response);
    }
}
