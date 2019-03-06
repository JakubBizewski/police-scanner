<?php

namespace PoliceScanner\Controller;

use PoliceScanner\Model\CitizenModel;
use PoliceScanner\Service\CitationService;
use PoliceScanner\Service\CitizenService;
use PoliceScanner\Service\VisaService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CitizenController extends BaseController
{
    private $citizenService;
    private $citationService;
    private $visaService;

    public function __construct(
        CitizenService $citizenService,
        CitationService $citationService,
        VisaService $visaService)
    {
        $this->citizenService = $citizenService;
        $this->citationService = $citationService;
        $this->visaService = $visaService;
    }

    /**
     * @param int $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citizen/{id}", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function getById($id)
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
     * @param int $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citizen/{id}/visa", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function getVisa($id)
    {
        $response = $this->visaService->getByOwnerId($id);

        return $this->createResponse($response);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citizen", methods={"GET"})
     */
    public function getCitizen(Request $request)
    {
        $name = $request->query->get('name');
        $birthday = $request->query->get('birthday');

        if ($name && $birthday)
            $response = $this->citizenService->getByFullNameAndBirthday($name, $birthday);
        else
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
