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
       return $this->frequency->getName()." - ".$this->moment->getName();
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Frequency")
     *
     */
    private $frequency;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Moment")
     *
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
