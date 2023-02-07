<?php

namespace App\Entity;

use App\Repository\TirageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TirageRepository::class)]
class Tirage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero1 = null;

    #[ORM\Column]
    private ?int $numero2 = null;

    #[ORM\Column]
    private ?int $numero3 = null;

    #[ORM\Column]
    private ?int $numero4 = null;

    #[ORM\Column]
    private ?int $numero5 = null;

    #[ORM\Column]
    private ?int $numerochance = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $montant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero1(): ?int
    {
        return $this->numero1;
    }

    public function setNumero1(int $numero1): self
    {
        $this->numero1 = $numero1;

        return $this;
    }

    public function getNumero2(): ?int
    {
        return $this->numero2;
    }

    public function setNumero2(int $numero2): self
    {
        $this->numero2 = $numero2;

        return $this;
    }

    public function getNumero3(): ?int
    {
        return $this->numero3;
    }

    public function setNumero3(int $numero3): self
    {
        $this->numero3 = $numero3;

        return $this;
    }

    public function getNumero4(): ?int
    {
        return $this->numero4;
    }

    public function setNumero4(int $numero4): self
    {
        $this->numero4 = $numero4;

        return $this;
    }

    public function getNumero5(): ?int
    {
        return $this->numero5;
    }

    public function setNumero5(int $numero5): self
    {
        $this->numero5 = $numero5;

        return $this;
    }

    public function getNumerochance(): ?int
    {
        return $this->numerochance;
    }

    public function setNumerochance(int $numerochance): self
    {
        $this->numerochance = $numerochance;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }
}
