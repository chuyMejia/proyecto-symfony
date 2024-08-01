<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex("/[a-zA-Z ]+/")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex("/^[a-zA-Z]+$/")
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Email(
     *      message = "email not valid '{{ value }}'"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="user")
     */
    private $tasks;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(?\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;
        return $this;
    }

    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    // Métodos de la interfaz UserInterface

    public function getUsername(): string
    {
        return $this->email; // Puedes devolver el email o cualquier otro campo único
    }

    public function getRoles(): array
    {
        // Asegúrate de que roles sean devueltos como un array
        return [$this->role ?? 'ROLE_USER'];
    }

    public function getSalt()
    {
        // No es necesario para bcrypt
        return null;
    }

    public function eraseCredentials()
    {
        // Si almacenas datos sensibles, límpialos aquí
    }
}
