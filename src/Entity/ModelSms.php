<?php

namespace App\Entity;

use App\Repository\ModelSmsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelSmsRepository::class)]
#[ORM\Table(name: '`rakhassalma_models_sms`')]
class ModelSms
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    private ?string $code = null;
    #[ORM\Column(length: 255, nullable: true)]

    private ?string $message = null;
    #[ORM\Column(type: 'json', nullable: true)]

    private $parametre = [];
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getParametre(): array
    {
        return $this->parametre;
    }

    public function setParametre(?array $parametre): self
    {
        $this->parametre = $parametre;

        return $this;
    }
}
