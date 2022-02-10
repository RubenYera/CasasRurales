<?php

namespace App\Entity;

use App\Repository\AlojamientoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(type: 'array', nullable: true)]
    private $fotos = [];

    #[ORM\ManyToOne(targetEntity: Tipo::class, inversedBy: 'Alojamiento')]
    #[ORM\JoinColumn(nullable: false)]
    private $tipo;

    #[ORM\ManyToMany(targetEntity: Comodidad::class, inversedBy: 'alojamientos')]
    private $Comodidades;

    #[ORM\OneToMany(mappedBy: 'alojamiento', targetEntity: Valoracion::class)]
    private $valoraciones;

    public function __construct()
    {
        $this->Comodidades = new ArrayCollection();
        $this->valoraciones = new ArrayCollection();
    }

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

    public function getFotos(): ?array
    {
        return $this->fotos;
    }

    public function setFotos(?array $fotos): self
    {
        $this->fotos = $fotos;

        return $this;
    }

    public function getTipo(): ?Tipo
    {
        return $this->tipo;
    }

    public function setTipo(?Tipo $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return Collection|Comodidad[]
     */
    public function getComodidades(): Collection
    {
        return $this->Comodidades;
    }

    public function addComodidade(Comodidad $comodidade): self
    {
        if (!$this->Comodidades->contains($comodidade)) {
            $this->Comodidades[] = $comodidade;
        }

        return $this;
    }

    public function removeComodidade(Comodidad $comodidade): self
    {
        $this->Comodidades->removeElement($comodidade);

        return $this;
    }

    /**
     * @return Collection|Valoracion[]
     */
    public function getValoraciones(): Collection
    {
        return $this->valoraciones;
    }

    public function addValoracione(Valoracion $valoracione): self
    {
        if (!$this->valoraciones->contains($valoracione)) {
            $this->valoraciones[] = $valoracione;
            $valoracione->setAlojamiento($this);
        }

        return $this;
    }

    public function removeValoracione(Valoracion $valoracione): self
    {
        if ($this->valoraciones->removeElement($valoracione)) {
            // set the owning side to null (unless already changed)
            if ($valoracione->getAlojamiento() === $this) {
                $valoracione->setAlojamiento(null);
            }
        }

        return $this;
    }
}
