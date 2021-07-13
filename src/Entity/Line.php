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
     * @ORM\ManyToOne(targetEntity="App\Entity\Dose")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $dose;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    private $product;

    /**
     * @ORM\Column(type="float", nullable=true, scale=1)
     */
    private $qty;

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

    public function __toString(){
        return $this->product->getName()." ".$this->dose;
    }

    public function getQty(): ?float
    {
        return $this->qty;
    }

    public function setQty(?float $qty): self
    {
        $this->qty = $qty;

        return $this;
    }

    public function getName(){
        return $this->getQty()." ".$this->getProduct()->getName()." - ".$this->getDose();
    }
}
