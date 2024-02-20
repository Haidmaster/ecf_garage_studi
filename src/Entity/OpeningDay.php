<?php

namespace App\Entity;

use App\Repository\OpeningDayRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningDayRepository::class)]
class OpeningDay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'openingDays')]
    private ?OpeningHour $openingHours = null;

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

    public function getOpeningHours(): ?OpeningHour
    {
        return $this->openingHours;
    }

    public function setOpeningHours(?OpeningHour $openingHours): static
    {
        $this->openingHours = $openingHours;

        return $this;
    }
}
