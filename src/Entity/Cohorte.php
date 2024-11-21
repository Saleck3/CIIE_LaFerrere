<?php

namespace App\Entity;

use App\Repository\CohorteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CohorteRepository::class)]
class Cohorte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\OneToMany(mappedBy: 'Cohorte', targetEntity: Resolucion::class)]
    private Collection $resoluciones;

    public function __construct()
    {
        $this->resoluciones = new ArrayCollection();
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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): static
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * @return Collection<int, Resolucion>
     */
    public function getResoluciones(): Collection
    {
        return $this->resoluciones;
    }

    public function addResolucione(Resolucion $resolucione): static
    {
        if (!$this->resoluciones->contains($resolucione)) {
            $this->resoluciones->add($resolucione);
            $resolucione->setCohorte($this);
        }

        return $this;
    }

    public function removeResolucione(Resolucion $resolucione): static
    {
        if ($this->resoluciones->removeElement($resolucione)) {
            // set the owning side to null (unless already changed)
            if ($resolucione->getCohorte() === $this) {
                $resolucione->setCohorte(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
