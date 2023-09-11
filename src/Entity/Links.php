<?php

namespace App\Entity;

use App\Repository\LinksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinksRepository::class)]
class Links
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombrelink = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombrelink(): ?string
    {
        return $this->nombrelink;
    }

    public function setNombrelink(string $nombrelink): static
    {
        $this->nombrelink = $nombrelink;

        return $this;
    }
}
