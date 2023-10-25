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

    #[ORM\Column(length: 30)] // Le prénom est stocké dans la base de données avec une limite de 30 caractères
    private string $firstname;

    #[ORM\Column(length: 40)] // Le nom de famille est stocké dans la base de données avec une limite de 40 caractères
    private string $lastname;

    #[ORM\Column(length: 100)] // L'adresse e-mail est stockée dans la base de données avec une limite de 100 caractères
    private string $email;

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
}
