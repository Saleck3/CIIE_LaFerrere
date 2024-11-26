<?php

namespace App\Entity;

use App\Repository\ResolucionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResolucionRepository::class)]
class Resolucion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $clave = null;

    #[ORM\ManyToOne(inversedBy: 'resoluciones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Curso $curso = null;

    #[ORM\ManyToOne(inversedBy: 'resoluciones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cohorte $cohorte = null;

    #[ORM\ManyToOne(inversedBy: 'resoluciones_dicta')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $docente = null;

    #[ORM\OneToMany(mappedBy: 'resolucion', targetEntity: Encuentro::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $encuentros;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'resoluciones_cursa')]
    private Collection $cursantes;

    public function __construct()
    {
        $this->encuentros = new ArrayCollection();
        $this->cursantes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDocente(): ?User
    {
        return $this->docente;
    }

    public function setDocente(?User $docente): static
    {
        $this->docente = $docente;

        return $this;
    }

    public function __toString()
    {
        return $this->clave;
    }

    /**
     * @return Collection<int, Encuentro>
     */
    public function getEncuentros(): Collection
    {
        return $this->encuentros;
    }

    public function addEncuentro(Encuentro $encuentro): static
    {
        if (!$this->encuentros->contains($encuentro)) {
            $this->encuentros->add($encuentro);
            $encuentro->setResolucion($this);
        }

        return $this;
    }

    public function removeEncuentro(Encuentro $encuentro): static
    {
        if ($this->encuentros->removeElement($encuentro)) {
            // set the owning side to null (unless already changed)
            if ($encuentro->getResolucion() === $this) {
                $encuentro->setResolucion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getCursantes(): Collection
    {
        return $this->cursantes;
    }

    public function addCursante(User $cursante): static
    {
        if (!$this->cursantes->contains($cursante)) {
            $this->cursantes->add($cursante);
        }

        return $this;
    }

    public function removeCursante(User $cursante): static
    {
        $this->cursantes->removeElement($cursante);

        return $this;
    }
}
