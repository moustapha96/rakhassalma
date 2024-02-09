<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'reservation:item']),
        new Post(normalizationContext: ['groups' => 'reservation:item']),
        new Put(normalizationContext: ['groups' => 'reservation:item']),
        new GetCollection(normalizationContext: ['groups' => 'reservation:list'])
    ],
    order: ['date' => 'DESC', 'paiement' => 'ASC'],
)]
#[Broadcast]
#[ORM\Table(name: '`rakhassalma_reservations`')]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['reservation:list', 'reservation:item'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['reservation:list', 'reservation:item'])]
    private ?\DateTimeInterface $date = null;
    #[Groups(['reservation:list', 'reservation:item'])]
    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Client $client = null;
    #[Groups(['reservation:list', 'reservation:item'])]
    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Station $station = null;
    #[Groups(['reservation:list', 'reservation:item'])]
    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Paiement $paiement = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[Groups(['reservation:list', 'reservation:item'])]
    private ?Etat $etat = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[Groups(['reservation:list', 'reservation:item'])]
    private ?TypeLavage $typeLavage = null;

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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(?Station $station): static
    {
        $this->station = $station;

        return $this;
    }

    public function getPaiement(): ?Paiement
    {
        return $this->paiement;
    }

    public function setPaiement(?Paiement $paiement): static
    {
        $this->paiement = $paiement;

        return $this;
    }

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getTypeLavage(): ?TypeLavage
    {
        return $this->typeLavage;
    }

    public function setTypeLavage(?TypeLavage $typeLavage): static
    {
        $this->typeLavage = $typeLavage;

        return $this;
    }
}
