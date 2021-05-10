<?php

namespace App\Entity;

use App\Repository\LineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LineRepository::class)
 */
class Line
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Dose", cascade={"persist", "remove"})
     */
    private $dose;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product", cascade={"persist", "remove"})
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDose(): ?Dose
    {
        return $this->dose;
    }

    public function setDose(?Dose $dose): self
    {
        $this->dose = $dose;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
