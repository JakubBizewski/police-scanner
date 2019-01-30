<?php

namespace PoliceScanner\Controller;

use PoliceScanner\Model\CitationSaveModel;
use PoliceScanner\Service\CitationService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CitationController extends BaseController
{
    private $citationService;

    public function __construct(CitationService $citationService)
    {
        $this->citationService = $citationService;
    }

    /**
     * @param int $id
     * @return object|\Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citation/{id}", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function get($id)
    {
        $response = $this->citationService->get($id);

        return $this->createResponse($response);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citation", methods={"GET"})
     */
    public function getAll()
    {
        $response = $this->citationService->getAll();

        return $this->createResponse($response);
    }

    /**
     * @param $request Request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citation", methods={"POST"})
     */
    public function post(Request $request)
    {
        $model = CitationSaveModel::fromRequest($request);
        $response = $this->citationService->create($model);

        return $this->createResponse($response);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citation", methods={"PUT"})
     */
    public function put(Request $request)
    {
        $model = CitationSaveModel::fromRequest($request);
        $response = $this->citationService->update($model);

        return $this->createResponse($response);
    }

    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/citation/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        $response = $this->citationService->delete($id);

        return $this->createResponse($response);
    }
}
