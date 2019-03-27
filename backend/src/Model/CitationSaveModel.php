<?php

namespace PoliceScanner\Model;

use PoliceScanner\Entity\Citation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class CitationSaveModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     * @Assert\NotBlank()
     */
    public $citizenId;

    /**
     * @var int
     * @Assert\NotBlank()
     */
    public $offenseId;

    /**
     * @var string
     * @Assert\DateTime(format="Y-m-d\TH:i:sP")
     * @Assert\NotBlank()
     */
    public $issueTime;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $description;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $status;

    public static function fromEntity(Citation $citation): self
    {
        $model = new self();
        $model->id = $citation->getId();
        $model->citizenId = $citation->getCitizen()->getId();
        $model->offenseId = $citation->getOffense()->getId();
        $model->issueTime = $citation->getIssueTime()->format(DATE_ATOM);
        $model->description = $citation->getDescription();
        $model->status = $citation->getStatus();

        return $model;
    }

    public static function fromRequest(Request $request): self
    {
        $data = json_decode($request->getContent());

        $model = new self();
        $model->id = isset($data->id) ? $data->id : null;
        $model->citizenId = isset($data->citizenId) ? $data->citizenId : null;
        $model->offenseId = isset($data->offenseId) ? $data->offenseId : null;
        $model->issueTime = isset($data->issueTime) ? $data->issueTime : null;
        $model->description = isset($data->description) ? $data->description : null;
        $model->status = isset($data->status) ? $data->status : null;

        return $model;
    }
}
