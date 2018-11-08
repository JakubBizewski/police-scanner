<?php

namespace PoliceScanner\Controller;

use PoliceScanner\Service\ServiceResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseController extends AbstractController
{
    /**
     * @param ServiceResponse $serviceResponse
     * @return JsonResponse
     */
    protected function createResponse(ServiceResponse $serviceResponse): JsonResponse
    {
        if ($serviceResponse->isSuccessful() && !is_null($serviceResponse->getResponseObject()))
            return $this->json($serviceResponse->getResponseObject(), $serviceResponse->getStatusCode());

        return $this->json($serviceResponse->getMessage(), $serviceResponse->getStatusCode());
    }
}
