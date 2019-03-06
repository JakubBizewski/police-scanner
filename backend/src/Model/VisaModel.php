<?php

namespace PoliceScanner\Model;

use PoliceScanner\Entity\Visa;

class VisaModel
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var CitizenModel
     */
    public $owner;

    /**
     * @var string
     */
    public $createTime;

    /**
     * @var string
     */
    public $expireTime;

    public static function fromEntity(Visa $visa): self
    {
        $model = new self();
        $model->id = $visa->getId();
        $model->owner = CitizenModel::fromEntity($visa->getOwner());
        $model->createTime = $visa->getCreateTime()->format(DATE_ATOM);
        $model->expireTime = $visa->getExpireTime()->format(DATE_ATOM);

        return $model;
    }
}
