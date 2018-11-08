<?php

namespace PoliceScanner\Controller;

use PoliceScanner\Model\VehicleModelModel;
use PoliceScanner\Service\VehicleModelService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VehicleModelController extends BaseController
{
    private $modelService;

    public function __construct(VehicleModelService $modelService)
    {
        $this->modelService = $modelService;
    }

    /**
     * @param int $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/model/{id}", methods={"GET"})
     */
    public function get($id)
    {
        $response = $this->modelService->get($id);

        return $this->createResponse($response);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/model", methods={"GET"})
     */
    public function getAll()
    {
        $response = $this->modelService->getAll();

        return $this->createResponse($response);
    }

    /**
     * @param $request Request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/model", methods={"POST"})
     */
    public function post(Request $request)
    {
        $model = VehicleModelModel::fromRequest($request);
        $response = $this->modelService->create($model);

        return $this->createResponse($response);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/model", methods={"PUT"})
     */
    public function put(Request $request)
    {
        $model = VehicleModelModel::fromRequest($request);
        $response = $this->modelService->update($model);

        return $this->createResponse($response);
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/model/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        $response = $this->modelService->delete($id);

        return $this->createResponse($response);
    }
}
