<?php

namespace PoliceScanner\Model;

use PoliceScanner\Entity\Citizen;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class CitizenModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $firstName;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $lastName;

    /**
     * @var string
     * @Assert\DateTime(format="Y-m-d\TH:i:sP")
     * @Assert\NotBlank()
     */
    public $dateOfBirth;

    public static function fromEntity(Citizen $citizen): self
    {
        $model = new self();
        $model->id = $citizen->getId();
        $model->firstName = $citizen->getFirstName();
        $model->lastName = $citizen->getLastName();
        $model->dateOfBirth = $citizen->getDateOfBirth()->format(DATE_ATOM);

        return $model;
    }

    public static function fromRequest(Request $request): self
    {
        $data = json_decode($request->getContent());

        $model = new self();
        $model->id = isset($data->id) ? $data->id : null;
        $model->firstName = isset($data->firstName) ? $data->firstName : null;
        $model->lastName = isset($data->lastName) ? $data->lastName : null;
        $model->dateOfBirth = isset($data->dateOfBirth) ? $data->dateOfBirth : null;

        return $model;
    }
}
