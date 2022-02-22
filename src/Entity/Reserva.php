<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $fecha_ini;

    #[ORM\Column(type: 'date')]
    private $fecha_fin;

    #[ORM\Column(type: 'datetime')]
    private $fecha_reserva;

    #[ORM\ManyToOne(targetEntity: Alojamiento::class, inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private $alojamiento;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private $User;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaIni(): ?\DateTimeInterface
    {
        return $this->fecha_ini;
    }

    public function setFechaIni(\DateTimeInterface $fecha_ini): self
    {
        $this->fecha_ini = $fecha_ini;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fecha_fin;
    }

    public function setFechaFin(\DateTimeInterface $fecha_fin): self
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    public function getFechaReserva(): ?\DateTimeInterface
    {
        return $this->fecha_reserva;
    }

    public function setFechaReserva(\DateTimeInterface $fecha_reserva): self
    {
        $this->fecha_reserva = $fecha_reserva;

        return $this;
    }

    public function getAlojamiento(): ?Alojamiento
    {
        return $this->alojamiento;
    }

    public function setAlojamiento(?Alojamiento $alojamiento): self
    {
        $this->alojamiento = $alojamiento;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
