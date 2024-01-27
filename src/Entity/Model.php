<?php

namespace App\Entity;

use App\Entity\Car;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ModelRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity('name', message: "Ce modèle existe déjà")]
#[ORM\Entity(repositoryClass: ModelRepository::class)]
class Model
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 32)]
    #[Assert\NotBlank(message: "Veuillez saisir un modèle")]
    #[Assert\Length(
        min: 2,
        minMessage: "La marque doit contenir au minimum {{ limit }} caractères",
        max: 32,
        maxMessage: "La marque ne peut pas dépasser {{ limit }} caractères"
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z\s-]+$/',
        message: 'Le modèle ne peut contenir que des lettres et des chiffres'
    )]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'models')]
    private ?Brand $brand = null;

    #[ORM\ManyToOne(inversedBy: 'models')]
    private ?Car $car = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): static
    {
        $this->car = $car;

        return $this;
    }
}
