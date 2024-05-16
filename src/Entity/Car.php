<?php

namespace App\Entity;

use App\Entity\Image;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CarRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['getCars'])]
    #[Assert\Positive]
    private ?int $mileage = null;

    #[ORM\Column]
    #[Groups(['getCars'])]
    #[Assert\Positive]
    private ?int $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['getCars'])]
    #[Assert\Positive]
    #[Assert\Length(
        min: 12,
        minMessage: "Le contenu doit contenir au moins {{ limit }} caractères",
        max: 256,
        maxMessage: "Le contenu de ne peut pas dépasser {{ limit }} caractères"
    )]
    // #[Assert\Regex(
    //     pattern: '/^[a-zA-Z\s-]+$/',
    //     message: 'Seuls les chiffres et les lettres sont autorisés'
    // )]
    private ?string $options = null;

    #[ORM\Column]
    #[Groups(['getCars'])]
    #[Assert\Length(
        min: 4,
        minMessage: "Le contenu doit faire au moins {{ limit }} caractères",
        max: 4,
        maxMessage: "Le contenu de ne peut pas dépasser {{ limit }} caractères"
    )]
    #[Assert\Positive]
    #[Assert\NotBlank(message: 'ce champ ne peut pas être vide')]
    #[Assert\Length(
        min: 4,
        max: 4,
        minMessage: 'L\'année doit faire au moins {{ limit }} caractères',
        maxMessage: 'L\' titre ne doit pas faire plus de {{ limit }} caractères'
    )]
    #[Assert\Regex(
        pattern: '/^[0-9]+$/',
        message: 'L\'année ne peut contenir qu\'un chiffre'
    )]
    private ?int $years = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['getCars'])]
    private ?Model $model = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[Groups(['getCars'])]
    private ?Gearbox $gearbox = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[Groups(['getCars'])]
    private ?Energy $energy = null;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Image::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    #[Groups(['getCars'])]
    private Collection $images;

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
}
