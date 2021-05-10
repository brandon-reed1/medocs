<?php

namespace App\Entity;

use App\Repository\DoseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DoseRepository::class)
 */
class Dose
{
    public function __toString()
    {
       return $this->frequency." - ".$this->moment;
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Frequency", cascade={"persist", "remove"})
     */
    private $frequency;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Moment", cascade={"persist", "remove"})
     */
    private $moment;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMoment(): ?Moment
    {
        return $this->moment;
    }

    public function setMoment(?Moment $moment): self
    {
        $this->moment = $moment;

        return $this;
    }

    public function getFrequency(): ?Frequency
    {
        return $this->frequency;
    }

    public function setFrequency(?Frequency $frequency): self
    {
        $this->frequency = $frequency;

        return $this;
    }

}
