<?php

namespace App\Entity;

use App\Repository\ValoracionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ValoracionRepository::class)]
class Valoracion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $nota_limpieza;

    #[ORM\Column(type: 'integer')]
    private $nota_ubicacion;

    #[ORM\Column(type: 'integer')]
    private $nota_instalaciones_servicios;

    #[ORM\ManyToOne(targetEntity: Alojamiento::class, inversedBy: 'valoraciones')]
    #[ORM\JoinColumn(nullable: false)]
    private $alojamiento;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'valoraciones')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'string', length: 255)]
    private $comentario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotaLimpieza(): ?int
    {
        return $this->nota_limpieza;
    }

    public function setNotaLimpieza(int $nota_limpieza): self
    {
        $this->nota_limpieza = $nota_limpieza;

        return $this;
    }

    public function getNotaUbicacion(): ?int
    {
        return $this->nota_ubicacion;
    }

    public function setNotaUbicacion(int $nota_ubicacion): self
    {
        $this->nota_ubicacion = $nota_ubicacion;

        return $this;
    }

    public function getNotaInstalacionesServicios(): ?int
    {
        return $this->nota_instalaciones_servicios;
    }

    public function setNotaInstalacionesServicios(int $nota_instalaciones_servicios): self
    {
        $this->nota_instalaciones_servicios = $nota_instalaciones_servicios;

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
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(string $comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }
}
