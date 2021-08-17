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
     * @ORM\JoinColumn(onDelete="SET NULL")
     *
     */
    private $frequency;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Moment")
     * @ORM\JoinColumn(onDelete="SET NULL")
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

    public function getName(){
        $name = '';
        if ($this->getFrequency()->getName()) $name .= $this->getFrequency()->getName()." ";
        if ($this->getMoment()->getName()) $name .= $this->getMoment()->getName();
        return  $name;
    }

}
