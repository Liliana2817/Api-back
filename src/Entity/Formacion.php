<?php

namespace App\Entity;

use App\Repository\FormacionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormacionRepository::class)]
class Formacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $duracion = null;

    #[ORM\Column(length: 255)]
    private ?string $centro = null;

    #[ORM\Column(length: 255)]
    private ?string $fechadeinicio = null;

    #[ORM\Column(length: 255)]
    private ?string $fechafin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDuracion(): ?string
    {
        return $this->duracion;
    }

    public function setDuracion(string $duracion): static
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getCentro(): ?string
    {
        return $this->centro;
    }

    public function setCentro(string $centro): static
    {
        $this->centro = $centro;

        return $this;
    }

    public function getFechadeinicio(): ?string
    {
        return $this->fechadeinicio;
    }

    public function setFechadeinicio(string $fechadeinicio): static
    {
        $this->fechadeinicio = $fechadeinicio;

        return $this;
    }

    public function getFechafin(): ?string
    {
        return $this->fechafin;
    }

    public function setFechafin(string $fechafin): static
    {
        $this->fechafin = $fechafin;

        return $this;
    }
}
