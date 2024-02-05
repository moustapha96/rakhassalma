<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentaire = null;

    #[ORM\Column(nullable: true)]
    private ?int $noteLavage = null;

    #[ORM\Column(nullable: true)]
    private ?int $noteStation = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getNoteLavage(): ?int
    {
        return $this->noteLavage;
    }

    public function setNoteLavage(?int $noteLavage): static
    {
        $this->noteLavage = $noteLavage;

        return $this;
    }

    public function getNoteStation(): ?int
    {
        return $this->noteStation;
    }

    public function setNoteStation(?int $noteStation): static
    {
        $this->noteStation = $noteStation;

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
