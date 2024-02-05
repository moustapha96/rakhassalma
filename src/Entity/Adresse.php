<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
#[ApiResource]
#[Broadcast]
#[ORM\Table(name: '`rakhassalma_adresses`')]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column(nullable: true)]
    private ?array $coordonnee = null;

    #[ORM\ManyToOne(inversedBy: 'adresses')]
    private ?Client $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getCoordonnee(): ?array
    {
        return $this->coordonnee;
    }

    public function setCoordonnee(?array $coordonnee): static
    {
        $this->coordonnee = $coordonnee;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }
}
