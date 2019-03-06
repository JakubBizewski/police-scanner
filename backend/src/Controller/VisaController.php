<?php

namespace PoliceScanner\Controller;

use PoliceScanner\Model\VisaSaveModel;
use PoliceScanner\Service\VisaService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VisaController extends BaseController
{
    private $visaService;

    public function __construct(VisaService $visaService)
    {
        $this->visaService = $visaService;
    }

    /**
     * @param int $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/visa/{id}", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function get($id)
    {
        $response = $this->visaService->get($id);

        return $this->createResponse($response);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/visa", methods={"GET"})
     */
    public function getAll()
    {
        $response = $this->visaService->getAll();

        return $this->createResponse($response);
    }

    /**
     * @param $request Request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/visa", methods={"POST"})
     */
    public function post(Request $request)
    {
        $model = VisaSaveModel::fromRequest($request);
        $response = $this->visaService->create($model);

        return $this->createResponse($response);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/visa", methods={"PUT"})
     */
    public function put(Request $request)
    {
        $model = VisaSaveModel::fromRequest($request);
        $response = $this->visaService->update($model);

        return $this->createResponse($response);
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/visa/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        $response = $this->visaService->delete($id);

        return $this->createResponse($response);
    }
}
