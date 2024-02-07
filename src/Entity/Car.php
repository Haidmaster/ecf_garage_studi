<?php

namespace App\Entity;

use App\Entity\Image;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CarRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $mileage = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(
        min: 12,
        minMessage: "Le contenu doit contenir au moins {{ limit }} caractères",
        max: 256,
        maxMessage: "Le contenu de ne peut pas dépasser {{ limit }} caractères"
    )]
    // #[Assert\Regex(
    //     pattern: '/^[a-zA-Z\s-]+$/',
    //     message: 'Seuls les les lettres sont autorisés'
    // )]
    private ?string $options = null;

    #[ORM\Column]
    #[Assert\Length(
        min: 4,
        minMessage: "Le contenu doit faire au moins {{ limit }} caractères",
        max: 4,
        maxMessage: "Le contenu de ne peut pas dépasser {{ limit }} caractères"
    )]
    #[Assert\Positive]
    #[Assert\Regex(
        pattern: '/^[0-9]+$/',
        message: 'L\'année ne peut contenir qu\'un chiffre'
    )]
    private ?int $years = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Model $model = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Gearbox $gearbox = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Energy $energy = null;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Image::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $images;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): static
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->options;
    }

    public function setOptions(?string $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function getYears(): ?int
    {
        return $this->years;
    }

    public function setYears(int $years): static
    {
        $this->years = $years;

        return $this;
    }


    public function getGearbox(): ?Gearbox
    {
        return $this->gearbox;
    }

    public function setGearbox(?Gearbox $gearbox): static
    {
        $this->gearbox = $gearbox;

        return $this;
    }

    public function getEnergy(): ?Energy
    {
        return $this->energy;
    }

    public function setEnergy(?Energy $energy): static
    {
        $this->energy = $energy;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setCar($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getCar() === $this) {
                $image->setCar(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
