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

    #[ORM\Column(length: 255)]
    private ?string $clave = null;

    #[ORM\OneToMany(mappedBy: 'Curso', targetEntity: Resolucion::class)]
    private Collection $Resoluciones;

    public function __construct()
    {
        $this->Resoluciones = new ArrayCollection();
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
        return $this->Resoluciones;
    }

    public function addResolucione(Resolucion $resolucione): static
    {
        if (!$this->Resoluciones->contains($resolucione)) {
            $this->Resoluciones->add($resolucione);
            $resolucione->setCurso($this);
        }

        return $this;
    }

    public function removeResolucione(Resolucion $resolucione): static
    {
        if ($this->Resoluciones->removeElement($resolucione)) {
            // set the owning side to null (unless already changed)
            if ($resolucione->getCurso() === $this) {
                $resolucione->setCurso(null);
            }
        }

        return $this;
    }
}
