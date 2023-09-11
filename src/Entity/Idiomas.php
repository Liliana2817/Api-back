<?php

namespace App\Entity;

use App\Repository\IdiomasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IdiomasRepository::class)]
class Idiomas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idioma = null;

    #[ORM\Column(length: 255)]
    private ?string $nivelhablado = null;

    #[ORM\Column(length: 255)]
    private ?string $nivelescrito = null;

    #[ORM\Column(length: 255)]
    private ?string $titulacion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdioma(): ?string
    {
        return $this->idioma;
    }

    public function setIdioma(string $idioma): static
    {
        $this->idioma = $idioma;

        return $this;
    }

    public function getNivelhablado(): ?string
    {
        return $this->nivelhablado;
    }

    public function setNivelhablado(string $nivelhablado): static
    {
        $this->nivelhablado = $nivelhablado;

        return $this;
    }

    public function getNivelescrito(): ?string
    {
        return $this->nivelescrito;
    }

    public function setNivelescrito(string $nivelescrito): static
    {
        $this->nivelescrito = $nivelescrito;

        return $this;
    }

    public function getTitulacion(): ?string
    {
        return $this->titulacion;
    }

    public function setTitulacion(string $titulacion): static
    {
        $this->titulacion = $titulacion;

        return $this;
    }
}
