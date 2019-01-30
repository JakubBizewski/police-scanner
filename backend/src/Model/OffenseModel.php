<?php

namespace PoliceScanner\Model;

use PoliceScanner\Entity\Offense;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class OffenseModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @var int
     * @Assert\NotBlank()
     */
    public $fine;

    /**
     * @var boolean
     * @Assert\NotBlank()
     */
    public $isFelony;

    public static function fromEntity(Offense $offense): self
    {
        $model = new self();
        $model->id = $offense->getId();
        $model->name = $offense->getName();
        $model->fine = $offense->getFine();
        $model->isFelony = $offense->getIsFelony();

        return $model;
    }

    public static function fromRequest(Request $request): self
    {
        $data = json_decode($request->getContent());

        $model = new self();
        $model->id = isset($data->id) ? $data->id : null;
        $model->name = isset($data->name) ? $data->name : null;
        $model->fine = isset($data->fine) ? $data->fine : null;
        $model->isFelony = isset($data->isFelony) ? $data->isFelony : null;

        return $model;
    }
}
