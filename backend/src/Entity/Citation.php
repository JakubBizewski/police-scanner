<?php

namespace PoliceScanner\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PoliceScanner\Repository\CitationRepository")
 */
class Citation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="PoliceScanner\Entity\Citizen", inversedBy="citations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $citizen;

    /**
     * @ORM\ManyToOne(targetEntity="PoliceScanner\Entity\Offense")
     */
    private $offense;

    /**
     * @ORM\Column(type="datetime")
     */
    private $issueTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCitizen(): ?Citizen
    {
        return $this->citizen;
    }

    public function setCitizen(?Citizen $citizen): self
    {
        $this->citizen = $citizen;

        return $this;
    }

    public function getOffense(): ?Offense
    {
        return $this->offense;
    }

    public function setOffense(?Offense $offense): self
    {
        $this->offense = $offense;

        return $this;
    }

    public function getIssueTime(): ?\DateTimeInterface
    {
        return $this->issueTime;
    }

    public function setIssueTime(\DateTimeInterface $issueTime): self
    {
        $this->issueTime = $issueTime;

        return $this;
    }
}
