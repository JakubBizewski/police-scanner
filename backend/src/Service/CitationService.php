<?php

namespace PoliceScanner\Service;

use PoliceScanner\Entity\Citation;
use PoliceScanner\Model\CitationModel;
use PoliceScanner\Model\CitationSaveModel;
use PoliceScanner\Repository\CitationRepository;
use PoliceScanner\Repository\CitizenRepository;
use PoliceScanner\Repository\OffenseRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CitationService
{
    private $citationRepository;
    private $citizenRepository;
    private $offenseRepository;
    private $validator;

    public function __construct(
        CitationRepository $repository,
        CitizenRepository $citizenRepository,
        OffenseRepository $offenseRepository,
        ValidatorInterface $validator)
    {
        $this->citationRepository = $repository;
        $this->citizenRepository = $citizenRepository;
        $this->offenseRepository = $offenseRepository;
        $this->validator = $validator;
    }

    public function get(int $id): ServiceResponse
    {
        try {
            $citation = $this->citationRepository->find($id);
            if ($citation) {
                $model = CitationModel::fromEntity($citation);

                return new ServiceResponse(200, "", $model);
            }

            return new ServiceResponse(404, "Citation $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function getAll(): ServiceResponse
    {
        try {
            $citations = $this->citationRepository->findAll();

            $models = array_map(function (Citation $citation) {
                return CitationModel::fromEntity($citation);
            }, $citations);

            return new ServiceResponse(200, "", $models);

        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function getForCitizenId(int $id): ServiceResponse
    {
        try {
            $citizen = $this->citizenRepository->find($id);
            if (!$citizen)
                return new ServiceResponse(404, "Citizen $id not found");

            $citations = $this->citationRepository->findByCitizen($citizen);
            $models = array_map(function (Citation $citation) {
                return CitationModel::fromEntity($citation);
            }, $citations);

            return new ServiceResponse(200, "", $models);
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function create(CitationSaveModel $model): ServiceResponse
    {
        try {
            $errors = $this->validator->validate($model);
            if (count($errors) > 0)
                return new ServiceResponse(400, $errors[0]);

            $citizen = $this->citizenRepository->find($model->citizenId);
            if (!$citizen)
                return new ServiceResponse(404, "Citizen not found");

            $offense = $this->offenseRepository->find($model->offenseId);
            if (!$offense)
                return new ServiceResponse(404, "Offense not found");

            $citation = new Citation();
            $citation->setCitizen($citizen);
            $citation->setOffense($offense);
            $citation->setIssueTime(new \DateTime($model->issueTime));
            $citation->setDescription($model->description);
            $citation->setStatus($model->status);

            $this->citationRepository->save($citation);

            return new ServiceResponse(201);
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function update(CitationSaveModel $model): ServiceResponse
    {
        try {
            if (is_null($model->id))
                return new ServiceResponse(400, "ID of Citation not set");

            $errors = $this->validator->validate($model);
            if (count($errors) > 0)
                return new ServiceResponse(400, $errors[0]);

            $citation = $this->citationRepository->find($model->id);
            if ($citation) {
                $citizen = $this->citizenRepository->find($model->citizenId);
                if (!$citizen)
                    return new ServiceResponse(404, "Citizen $model->citizenId not found");

                $offense = $this->offenseRepository->find($model->offenseId);
                if (!$offense)
                    return new ServiceResponse(404, "Offense $model->offenseId not found");

                $citation->setCitizen($citizen);
                $citation->setOffense($offense);
                $citation->setIssueTime(new \DateTime($model->issueTime));
                $citation->setDescription($model->description);
                $citation->setStatus($model->status);

                $this->citationRepository->save($citation);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Citation $model->id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }

    public function delete(int $id): ServiceResponse
    {
        try {
            $citation = $this->citationRepository->find($id);
            if ($citation) {
                $this->citationRepository->delete($citation);

                return new ServiceResponse(204);
            }

            return new ServiceResponse(404, "Citation $id not found");
        } catch (\Exception $exception) {
            return new ServiceResponse(500, $exception->getMessage());
        }
    }
}
