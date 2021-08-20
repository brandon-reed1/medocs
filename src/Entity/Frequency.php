<?php

namespace App\Entity;

use App\Repository\FrequencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FrequencyRepository::class)
 */
class Frequency
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dose", mappedBy="frequency", orphanRemoval=true, cascade={"remove"})
     *
     */
    private $dose;

    public function __construct()
    {
        $this->dose = new ArrayCollection();
    }

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

    /**
     * @return Collection|Dose[]
     */
    public function getDose(): Collection
    {
        return $this->dose;
    }

    public function addDose(Dose $dose): self
    {
        if (!$this->dose->contains($dose)) {
            $this->dose[] = $dose;
            $dose->setFrequency($this);
        }

        return $this;
    }

    public function removeDose(Dose $dose): self
    {
        if ($this->dose->removeElement($dose)) {
            // set the owning side to null (unless already changed)
            if ($dose->getFrequency() === $this) {
                $dose->setFrequency(null);
            }
        }

        return $this;
    }
}
