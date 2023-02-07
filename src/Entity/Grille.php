<?php

namespace App\Entity;

use App\Repository\GrilleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GrilleRepository::class)]
class Grille
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

    #[ORM\ManyToOne(inversedBy: 'grilles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?bool $traitee = null;

    #[ORM\Column(nullable: true)]
    private ?float $gain = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbBonNumero = null;

    #[ORM\Column(nullable: true)]
    private ?bool $bonNumerChance = null;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function isTraitee(): ?bool
    {
        return $this->traitee;
    }

    public function setTraitee(bool $traitee): self
    {
        $this->traitee = $traitee;

        return $this;
    }

    public function getGain(): ?float
    {
        return $this->gain;
    }

    public function setGain(?float $gain): self
    {
        $this->gain = $gain;

        return $this;
    }

    public function getNbBonNumero(): ?int
    {
        return $this->nbBonNumero;
    }

    public function setNbBonNumero(?int $nbBonNumero): self
    {
        $this->nbBonNumero = $nbBonNumero;

        return $this;
    }

    public function isBonNumerChance(): ?bool
    {
        return $this->bonNumerChance;
    }

    public function setBonNumerChance(?bool $bonNumerChance): self
    {
        $this->bonNumerChance = $bonNumerChance;

        return $this;
    }

}
