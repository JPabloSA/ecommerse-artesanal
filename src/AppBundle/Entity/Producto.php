<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 *
 * @ORM\Table(name="producto", indexes={@ORM\Index(name="fk_producto_categoria1_idx", columns={"categoria_idcategoria"})})
 * @ORM\Entity
 */
class Producto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idproducto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproducto;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=600, nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="existencia", type="integer", nullable=true)
     */
    private $existencia;

    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float", precision=10, scale=0, nullable=true)
     */
    private $precio;

    /**
     * @var float
     *
     * @ORM\Column(name="preciomayorista", type="float", precision=10, scale=0, nullable=true)
     */
    private $preciomayorista;

    /**
     * @var string
     *
     * @ORM\Column(name="imgurl", type="string", length=200, nullable=true)
     */
    private $imgurl;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_idcategoria", referencedColumnName="idcategoria")
     * })
     */
    private $categoriacategoria;



    /**
     * Get idproducto
     *
     * @return integer
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Producto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Producto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set existencia
     *
     * @param integer $existencia
     *
     * @return Producto
     */
    public function setExistencia($existencia)
    {
        $this->existencia = $existencia;

        return $this;
    }

    /**
     * Get existencia
     *
     * @return integer
     */
    public function getExistencia()
    {
        return $this->existencia;
    }

    /**
     * Set precio
     *
     * @param float $precio
     *
     * @return Producto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set preciomayorista
     *
     * @param float $preciomayorista
     *
     * @return Producto
     */
    public function setPreciomayorista($preciomayorista)
    {
        $this->preciomayorista = $preciomayorista;

        return $this;
    }

    /**
     * Get preciomayorista
     *
     * @return float
     */
    public function getPreciomayorista()
    {
        return $this->preciomayorista;
    }

    /**
     * Set imgurl
     *
     * @param string $imgurl
     *
     * @return Producto
     */
    public function setImgurl($imgurl)
    {
        $this->imgurl = $imgurl;

        return $this;
    }

    /**
     * Get imgurl
     *
     * @return string
     */
    public function getImgurl()
    {
        return $this->imgurl;
    }

    /**
     * Set categoriacategoria
     *
     * @param \AppBundle\Entity\Categoria $categoriacategoria
     *
     * @return Producto
     */
    public function setCategoriacategoria(\AppBundle\Entity\Categoria $categoriacategoria = null)
    {
        $this->categoriacategoria = $categoriacategoria;

        return $this;
    }

    /**
     * Get categoriacategoria
     *
     * @return \AppBundle\Entity\Categoria
     */
    public function getCategoriacategoria()
    {
        return $this->categoriacategoria;
    }
}
