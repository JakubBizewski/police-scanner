<?php

namespace PoliceScanner\Controller;

use PoliceScanner\Model\OffenseModel;
use PoliceScanner\Service\OffenseService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OffenseController extends BaseController
{
    private $offenseService;

    public function __construct(OffenseService $offenseService)
    {
        $this->offenseService = $offenseService;
    }

    /**
     * @param int $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/offense/{id}", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function get($id)
    {
        $response = $this->offenseService->get($id);

        return $this->createResponse($response);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/offense", methods={"GET"})
     */
    public function getAll()
    {
        $response = $this->offenseService->getAll();

        return $this->createResponse($response);
    }

    /**
     * @param $request Request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/offense", methods={"POST"})
     */
    public function post(Request $request)
    {
        $model = OffenseModel::fromRequest($request);
        $response = $this->offenseService->create($model);

        return $this->createResponse($response);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/offense", methods={"PUT"})
     */
    public function put(Request $request)
    {
        $model = OffenseModel::fromRequest($request);
        $response = $this->offenseService->update($model);

        return $this->createResponse($response);
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/offense/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        $response = $this->offenseService->delete($id);

        return $this->createResponse($response);
    }
}
