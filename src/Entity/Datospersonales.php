<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DatospersonalesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DatospersonalesRepository::class)]
#[ApiResource]
class Datospersonales
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Datospersonales = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatospersonales(): ?string
    {
        return $this->Datospersonales;
    }

    public function setDatospersonales(string $Datospersonales): static
    {
        $this->Datospersonales = $Datospersonales;

        return $this;
    }
}
