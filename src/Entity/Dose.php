<?php

namespace App\Entity;

use App\Repository\DoseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Frequency", inversedBy="dose")
     * @ORM\JoinColumn(onDelete="SET NULL")
     *
     */
    private $frequency;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Moment", inversedBy="dose")
     * @ORM\JoinColumn(onDelete="SET NULL")
     *
     */
    private $moment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Line", mappedBy="dose", orphanRemoval=true, cascade={"remove"})
     */
    private $line;

    public function __construct()
    {
        $this->line = new ArrayCollection();
    }

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
        if ($this->getFrequency()) $name .= $this->getFrequency()->getName()." ";
        if ($this->getMoment()) $name .= $this->getMoment()->getName();
        return  $name;
    }

    /**
     * @return Collection|Line[]
     */
    public function getLine(): Collection
    {
        return $this->line;
    }

    public function addLine(Line $line): self
    {
        if (!$this->line->contains($line)) {
            $this->line[] = $line;
            $line->setDose($this);
        }

        return $this;
    }

    public function removeLine(Line $line): self
    {
        if ($this->line->removeElement($line)) {
            // set the owning side to null (unless already changed)
            if ($line->getDose() === $this) {
                $line->setDose(null);
            }
        }

        return $this;
    }

}
