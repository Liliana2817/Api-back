<?php

namespace App\Entity;

use App\Repository\ExperienciLaboralRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExperienciLaboralRepository::class)]
class ExperienciLaboral
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreempresa = null;

    #[ORM\Column(length: 255)]
    private ?string $puesto = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255)]
    private ?string $fechainicio = null;

    #[ORM\Column(length: 255)]
    private ?string $fechafin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreempresa(): ?string
    {
        return $this->nombreempresa;
    }

    public function setNombreempresa(string $nombreempresa): static
    {
        $this->nombreempresa = $nombreempresa;

        return $this;
    }

    public function getPuesto(): ?string
    {
        return $this->puesto;
    }

    public function setPuesto(string $puesto): static
    {
        $this->puesto = $puesto;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFechainicio(): ?string
    {
        return $this->fechainicio;
    }

    public function setFechainicio(string $fechainicio): static
    {
        $this->fechainicio = $fechainicio;

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
