<?php

namespace App\Entity;

use App\Repository\DoseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DoseRepository::class)
 */
class Dose
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $name;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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
