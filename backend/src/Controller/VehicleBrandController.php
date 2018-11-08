<?php

namespace PoliceScanner\Controller;

use PoliceScanner\Model\VehicleBrandModel;
use PoliceScanner\Service\VehicleBrandService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VehicleBrandController extends BaseController
{
    private $brandService;

    public function __construct(VehicleBrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * @param int $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/brand/{id}", methods={"GET"})
     */
    public function get($id)
    {
        $response = $this->brandService->get($id);

        return $this->createResponse($response);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/brand", methods={"GET"})
     */
    public function getAll()
    {
        $response = $this->brandService->getAll();

        return $this->createResponse($response);
    }

    /**
     * @param $request Request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/brand", methods={"POST"})
     */
    public function post(Request $request)
    {
        $model = VehicleBrandModel::fromRequest($request);
        $response = $this->brandService->create($model);

        return $this->createResponse($response);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/brand", methods={"PUT"})
     */
    public function put(Request $request)
    {
        $model = VehicleBrandModel::fromRequest($request);
        $response = $this->brandService->update($model);

        return $this->createResponse($response);
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/brand/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        $response = $this->brandService->delete($id);

        return $this->createResponse($response);
    }
}
