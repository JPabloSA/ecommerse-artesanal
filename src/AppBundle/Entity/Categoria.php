<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria", indexes={@ORM\Index(name="fk_categoria_empresa1_idx", columns={"empresa_idempresa"})})
 * @ORM\Entity
 */
class Categoria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcategoria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategoria;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=60, nullable=true)
     */
    private $nombre;

    /**
     * @var \Empresa
     *
     * @ORM\ManyToOne(targetEntity="Empresa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="empresa_idempresa", referencedColumnName="idempresa")
     * })
     */
    private $empresaempresa;



    /**
     * Get idcategoria
     *
     * @return integer
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Categoria
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
     * Set empresaempresa
     *
     * @param \AppBundle\Entity\Empresa $empresaempresa
     *
     * @return Categoria
     */
    public function setEmpresaempresa(\AppBundle\Entity\Empresa $empresaempresa = null)
    {
        $this->empresaempresa = $empresaempresa;

        return $this;
    }

    /**
     * Get empresaempresa
     *
     * @return \AppBundle\Entity\Empresa
     */
    public function getEmpresaempresa()
    {
        return $this->empresaempresa;
    }
}
