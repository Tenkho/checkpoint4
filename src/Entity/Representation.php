<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RepresentationRepository")
 */
class Representation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localisation;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxPlace;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Performs", inversedBy="shows")
     */
    private $performs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="spectacle", orphanRemoval=true)
     */
    private $reservations;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $name;

    public function __construct()
    {
        $this->performs = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getMaxPlace(): ?int
    {
        return $this->maxPlace;
    }

    public function setMaxPlace(int $maxPlace): self
    {
        $this->maxPlace = $maxPlace;

        return $this;
    }

    /**
     * @return Collection|Performs[]
     */
    public function getPerforms(): Collection
    {
        return $this->performs;
    }

    public function addPerform(Performs $perform): self
    {
        if (!$this->performs->contains($perform)) {
            $this->performs[] = $perform;
        }

        return $this;
    }

    public function removePerform(Performs $perform): self
    {
        if ($this->performs->contains($perform)) {
            $this->performs->removeElement($perform);
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setSpectacle($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getSpectacle() === $this) {
                $reservation->setSpectacle(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
