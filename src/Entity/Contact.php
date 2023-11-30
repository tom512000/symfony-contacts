<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id] // L'identifiant est la clé primaire de la table de la base de données
    #[ORM\GeneratedValue] // Sa valeur est générée automatiquement (auto-incrémentée)
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 30)]
    private string $firstname;

    #[ORM\Column(length: 40)]
    private string $lastname;

    #[ORM\Column(length: 100)]
    private string $email;

    #[ORM\Column(length: 20)]
    private ?string $phone = null;

    #[ORM\ManyToOne(inversedBy: 'contacts')]
    private ?Category $category = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
