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

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $placeOfBirth;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $nationality;

    /**
     * @var integer
     * @Assert\GreaterThan(value="0")
     */
    public $height;

    /**
     * @var integer
     * @Assert\GreaterThan(value="0")
     */
    public $weight;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $addressStreet;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $addressCity;

    public static function fromEntity(Citizen $citizen): self
    {
        $model = new self();
        $model->id = $citizen->getId();
        $model->firstName = $citizen->getFirstName();
        $model->lastName = $citizen->getLastName();
        $model->dateOfBirth = $citizen->getDateOfBirth()->format(DATE_ATOM);
        $model->placeOfBirth = $citizen->getPlaceOfBirth();
        $model->nationality = $citizen->getNationality();
        $model->height = $citizen->getHeight();
        $model->weight = $citizen->getWeight();
        $model->addressStreet = $citizen->getAddressStreet();
        $model->addressCity = $citizen->getAddressCity();

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
        $model->placeOfBirth = isset($data->placeOfBirth) ? $data->placeOfBirth : null;
        $model->nationality = isset($data->nationality) ? $data->nationality : null;
        $model->height = isset($data->height) ? $data->height : null;
        $model->weight = isset($data->weight) ? $data->weight : null;
        $model->addressStreet = isset($data->addressStreet) ? $data->addressStreet : null;
        $model->addressCity = isset($data->addressCity) ? $data->addressCity : null;

        return $model;
    }
}
