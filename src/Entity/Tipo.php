<?php

namespace App\Entity;

use App\Repository\TipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoRepository::class)]
class Tipo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\OneToMany(mappedBy: 'tipo', targetEntity: Alojamiento::class)]
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
            $alojamiento->setTipo($this);
        }

        return $this;
    }

    public function removeAlojamiento(Alojamiento $alojamiento): self
    {
        if ($this->alojamientos->removeElement($alojamiento)) {
            // set the owning side to null (unless already changed)
            if ($alojamiento->getTipo() === $this) {
                $alojamiento->setTipo(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->nombre;
    }
}
