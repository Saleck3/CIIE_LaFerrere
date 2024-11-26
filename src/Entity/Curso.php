<?php

namespace App\Entity;

use App\Repository\CursoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CursoRepository::class)]
class Curso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'curso', targetEntity: Resolucion::class)]
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

    public function getClave(): ?string
    {
        return $this->clave;
    }

    public function setClave(string $clave): static
    {
        $this->clave = $clave;

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
            $resolucione->setCurso($this);
        }

        return $this;
    }

    public function removeResolucione(Resolucion $resolucione): static
    {
        if ($this->resoluciones->removeElement($resolucione)) {
            // set the owning side to null (unless already changed)
            if ($resolucione->getCurso() === $this) {
                $resolucione->setCurso(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
