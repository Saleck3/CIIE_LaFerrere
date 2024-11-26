<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[UniqueEntity('email')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var string The UN-hashed password (Has no persistance)
     */
    public string $temp_password = '';

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\OneToMany(mappedBy: 'docente', targetEntity: Resolucion::class)]
    private Collection $resoluciones_dicta;

    #[ORM\ManyToMany(targetEntity: Resolucion::class, mappedBy: 'cursantes')]
    private Collection $resoluciones_cursa;

    #[ORM\ManyToMany(targetEntity: Encuentro::class, inversedBy: 'asistentes')]
    private Collection $asistencias;

    #[ORM\Column]
    private ?int $dni = null;

    public function __construct()
    {
        $this->resoluciones_dicta = new ArrayCollection();
        $this->resoluciones_cursa = new ArrayCollection();
        $this->asistencias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getTempPassword(): string
    {
        return $this->temp_password;
    }

    public function setTempPassword($tempPassword): static
    {
        $this->temp_password = $tempPassword;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public static function getAvailableRoles(): array
    {
        return [
            "Profesor" => "ROLE_TEACHER",
            "Admin" => "ROLE_ADMIN",
            "Super Admin" => "ROLE_SUPER_ADMIN",
        ];
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection<int, Resolucion>
     */
    public function getResolucionesDicta(): Collection
    {
        return $this->resoluciones_dicta;
    }

    public function addResolucione(Resolucion $resolucione): static
    {
        if (!$this->resoluciones_dicta->contains($resolucione)) {
            $this->resoluciones_dicta->add($resolucione);
            $resolucione->setDocente($this);
        }

        return $this;
    }

    public function removeResolucione(Resolucion $resolucione): static
    {
        if ($this->resoluciones_dicta->removeElement($resolucione)) {
            // set the owning side to null (unless already changed)
            if ($resolucione->getDocente() === $this) {
                $resolucione->setDocente(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->username;
    }

    /**
     * @return Collection<int, Resolucion>
     */
    public function getResolucionesCursa(): Collection
    {
        return $this->resoluciones_cursa;
    }

    public function addResolucionesCursa(Resolucion $resolucionesCursa): static
    {
        if (!$this->resoluciones_cursa->contains($resolucionesCursa)) {
            $this->resoluciones_cursa->add($resolucionesCursa);
            $resolucionesCursa->addCursante($this);
        }

        return $this;
    }

    public function removeResolucionesCursa(Resolucion $resolucionesCursa): static
    {
        if ($this->resoluciones_cursa->removeElement($resolucionesCursa)) {
            $resolucionesCursa->removeCursante($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Encuentro>
     */
    public function getAsistencias(): Collection
    {
        return $this->asistencias;
    }

    public function addAsistencia(Encuentro $asistencia): static
    {
        if (!$this->asistencias->contains($asistencia)) {
            $this->asistencias->add($asistencia);
        }

        return $this;
    }

    public function removeAsistencia(Encuentro $asistencia): static
    {
        $this->asistencias->removeElement($asistencia);

        return $this;
    }

    public function getDni(): ?int
    {
        return $this->dni;
    }

    public function setDni(int $dni): static
    {
        $this->dni = $dni;

        return $this;
    }
}
