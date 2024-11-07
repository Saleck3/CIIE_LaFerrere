<?php

namespace App\Entity;

use App\Repository\ResolucionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResolucionRepository::class)]
class Resolucion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'Resoluciones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Curso $curso = null;

    #[ORM\ManyToOne(inversedBy: 'resoluciones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cohorte $cohorte = null;

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

    public function getCurso(): ?Curso
    {
        return $this->curso;
    }

    public function setCurso(?Curso $curso): static
    {
        $this->curso = $curso;

        return $this;
    }

    public function getCohorte(): ?Cohorte
    {
        return $this->cohorte;
    }

    public function setCohorte(?Cohorte $cohorte): static
    {
        $this->cohorte = $cohorte;

        return $this;
    }
}
