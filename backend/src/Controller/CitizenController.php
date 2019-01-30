<?php

namespace PoliceScanner\Controller;

use PoliceScanner\Model\CitizenModel;
use PoliceScanner\Service\CitationService;
use PoliceScanner\Service\CitizenService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CitizenController extends BaseController
{
    private $citizenService;
    private $citationService;

    public function __construct(CitizenService $citizenService, CitationService $citationService)
    {
        $this->citizenService = $citizenService;
        $this->citationService = $citationService;
    }

    /**
     * @param int $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citizen/{id}", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function get($id)
    {
        $response = $this->citizenService->get($id);

        return $this->createResponse($response);
    }

    /**
     * @param int $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citizen/{id}/citations", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function getCitations($id)
    {
        $response = $this->citationService->getForCitizenId($id);

        return $this->createResponse($response);
    }

    /**
     * @param string $name
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citizen/{name}", methods={"GET"})
     */
    public function getByFullName($name)
    {
        $response = $this->citizenService->getByFullName($name);

        return $this->createResponse($response);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citizen", methods={"GET"})
     */
    public function getAll()
    {
        $response = $this->citizenService->getAll();

        return $this->createResponse($response);
    }

    /**
     * @param $request Request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citizen", methods={"POST"})
     */
    public function post(Request $request)
    {
        $model = CitizenModel::fromRequest($request);
        $response = $this->citizenService->create($model);

        return $this->createResponse($response);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citizen", methods={"PUT"})
     */
    public function put(Request $request)
    {
        $model = CitizenModel::fromRequest($request);
        $response = $this->citizenService->update($model);

        return $this->createResponse($response);
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citizen/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        $response = $this->citizenService->delete($id);

        return $this->createResponse($response);
    }
}
