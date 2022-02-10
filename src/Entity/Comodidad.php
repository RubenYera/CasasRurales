<?php

namespace App\Entity;

use App\Repository\ComodidadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComodidadRepository::class)]
class Comodidad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\ManyToMany(targetEntity: Alojamiento::class, mappedBy: 'Comodidades')]
    private $alojamientos;

    public function __construct()
    {
        $this->alojamientos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection|Alojamiento[]
     */
    public function getAlojamientos(): Collection
    {
        return $this->alojamientos;
    }

    public function addAlojamiento(Alojamiento $alojamiento): self
    {
        if (!$this->alojamientos->contains($alojamiento)) {
            $this->alojamientos[] = $alojamiento;
            $alojamiento->addComodidade($this);
        }

        return $this;
    }

    public function removeAlojamiento(Alojamiento $alojamiento): self
    {
        if ($this->alojamientos->removeElement($alojamiento)) {
            $alojamiento->removeComodidade($this);
        }

        return $this;
    }
}
