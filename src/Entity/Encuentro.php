<?php

namespace App\Entity;

use App\Repository\EncuentroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EncuentroRepository::class)]
class Encuentro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'encuentros')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Resolucion $resolucion = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'asistencias')]
    private Collection $asistentes;

    public function __construct()
    {
        $this->asistentes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;
        return $this;
    }

    public function getResolucion(): ?Resolucion
    {
        return $this->resolucion;
    }

    public function setResolucion(?Resolucion $resolucion): static
    {
        $this->resolucion = $resolucion;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAsistentes(): Collection
    {
        return $this->asistentes;
    }

    public function addAsistente(User $asistente): static
    {
        if (!$this->asistentes->contains($asistente)) {
            $this->asistentes->add($asistente);
            $asistente->addAsistencia($this);
        }

        return $this;
    }

    public function removeAsistente(User $asistente): static
    {
        if ($this->asistentes->removeElement($asistente)) {
            $asistente->removeAsistencia($this);
        }

        return $this;
    }
}
