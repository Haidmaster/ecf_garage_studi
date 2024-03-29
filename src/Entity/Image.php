<?php

namespace App\Entity;

use App\Entity\Car;
use App\Entity\Prestation;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImageRepository;


#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Car $car = null;

    #[ORM\OneToOne(mappedBy: 'image', cascade: ['persist', 'remove'])]
    private ?Prestation $prestation = null;

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

    public function getPrestation(): ?Prestation
    {
        return $this->prestation;
    }

    public function setPrestation(?Prestation $prestation): static
    {
        // unset the owning side of the relation if necessary
        if ($prestation === null && $this->prestation !== null) {
            $this->prestation->setImage(null);
        }

        // set the owning side of the relation if necessary
        if ($prestation !== null && $prestation->getImage() !== $this) {
            $prestation->setImage($this);
        }

        $this->prestation = $prestation;

        return $this;
    }
}
