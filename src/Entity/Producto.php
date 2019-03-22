<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Swagger\Annotations as SWG;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductoRepository")
 */
class Producto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @SWG\Property(example="2")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @SWG\Property(example="Fideo")
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     * @SWG\Property(example="Sumesa")
     */
    private $marca;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @SWG\Property(example="Fideos")
     */
    private $categoria;

    /**
     * @ORM\Column(type="boolean")
     * @SWG\Property(example="true")
     */
    private $estado;

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function setMarca(string $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado(bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}
