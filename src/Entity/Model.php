<?php

namespace App\Entity;

use App\Entity\Car;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ModelRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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

    #[ORM\OneToMany(mappedBy: 'model', targetEntity: Car::class, cascade: ['persist'])]
    private Collection $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    /**
     * @return Collection<int, Car>
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
            $car->setModel($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getModel() === $this) {
                $car->setModel(null);
            }
        }

        return $this;
    }
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
}
