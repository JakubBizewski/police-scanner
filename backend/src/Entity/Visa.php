<?php

namespace PoliceScanner\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PoliceScanner\Repository\VisaRepository")
 */
class Visa
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createTime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expireTime;

    /**
     * @ORM\OneToOne(targetEntity="PoliceScanner\Entity\Citizen", inversedBy="visa", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateTime(): ?\DateTimeInterface
    {
        return $this->createTime;
    }

    public function setCreateTime(\DateTimeInterface $createTime): self
    {
        $this->createTime = $createTime;

        return $this;
    }

    public function getExpireTime(): ?\DateTimeInterface
    {
        return $this->expireTime;
    }

    public function setExpireTime(\DateTimeInterface $expireTime): self
    {
        $this->expireTime = $expireTime;

        return $this;
    }

    public function getOwner(): ?Citizen
    {
        return $this->owner;
    }

    public function setOwner(Citizen $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
