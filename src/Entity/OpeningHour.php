<?php

namespace App\Entity;

use App\Repository\OpeningHourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningHourRepository::class)]
class OpeningHour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $openAm = null;

    #[ORM\Column(length: 50)]
    private ?string $closeAm = null;

    #[ORM\Column(length: 50)]
    private ?string $openPm = null;

    #[ORM\Column(length: 50)]
    private ?string $closePm = null;

    #[ORM\Column(length: 50)]
    private ?string $closed = null;

    #[ORM\OneToMany(mappedBy: 'openingHours', targetEntity: OpeningDay::class)]
    private Collection $openingDays;

    public function __construct()
    {
        $this->openingDays = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOpenAm(): ?string
    {
        return $this->openAm;
    }

    public function setOpenAm(string $openAm): static
    {
        $this->openAm = $openAm;

        return $this;
    }

    public function getCloseAm(): ?string
    {
        return $this->closeAm;
    }

    public function setCloseAm(string $closeAm): static
    {
        $this->closeAm = $closeAm;

        return $this;
    }

    public function getOpenPm(): ?string
    {
        return $this->openPm;
    }

    public function setOpenPm(string $openPm): static
    {
        $this->openPm = $openPm;

        return $this;
    }

    public function getClosePm(): ?string
    {
        return $this->closePm;
    }

    public function setClosePm(string $closePm): static
    {
        $this->closePm = $closePm;

        return $this;
    }

    public function getClosed(): ?string
    {
        return $this->closed;
    }

    public function setClosed(string $closed): static
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * @return Collection<int, OpeningDay>
     */
    public function getOpeningDays(): Collection
    {
        return $this->openingDays;
    }

    public function addOpeningDay(OpeningDay $openingDay): static
    {
        if (!$this->openingDays->contains($openingDay)) {
            $this->openingDays->add($openingDay);
            $openingDay->setOpeningHours($this);
        }

        return $this;
    }

    public function removeOpeningDay(OpeningDay $openingDay): static
    {
        if ($this->openingDays->removeElement($openingDay)) {
            // set the owning side to null (unless already changed)
            if ($openingDay->getOpeningHours() === $this) {
                $openingDay->setOpeningHours(null);
            }
        }

        return $this;
    }
}
