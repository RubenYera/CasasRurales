<?php

namespace App\Entity;

use App\Repository\AlojamientoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlojamientoRepository::class)]
class Alojamiento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $descripcion;

    #[ORM\Column(type: 'float')]
    private $precio;

    #[ORM\Column(type: 'float')]
    private $fianza;

    #[ORM\Column(type: 'integer')]
    private $habitaciones;

    #[ORM\Column(type: 'integer')]
    private $camas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getFianza(): ?float
    {
        return $this->fianza;
    }

    public function setFianza(float $fianza): self
    {
        $this->fianza = $fianza;

        return $this;
    }

    public function getHabitaciones(): ?int
    {
        return $this->habitaciones;
    }

    public function setHabitaciones(int $habitaciones): self
    {
        $this->habitaciones = $habitaciones;

        return $this;
    }

    public function getCamas(): ?int
    {
        return $this->camas;
    }

    public function setCamas(int $camas): self
    {
        $this->camas = $camas;

        return $this;
    }
}
