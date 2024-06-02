<?php

namespace App\Entity;

use App\Entity\Car;
use App\Entity\Service;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImageRepository;
use Symfony\Component\Serializer\Attribute\Groups;


#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['getCars'])]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Car $car = null;

    #[ORM\OneToOne(mappedBy: 'image', cascade: ['persist', 'remove'])]
    private ?Service $service = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

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

    public function getservice(): ?Service
    {
        return $this->service;
    }

    public function setservice(?Service $service): static
    {
        // unset the owning side of the relation if necessary
        if ($service === null && $this->service !== null) {
            $this->service->setImage(null);
        }

        // set the owning side of the relation if necessary
        if ($service !== null && $service->getImage() !== $this) {
            $service->setImage($this);
        }

        $this->service = $service;

        return $this;
    }
}
