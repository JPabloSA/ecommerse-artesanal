<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Colaborador
 *
 * @ORM\Table(name="colaborador", indexes={@ORM\Index(name="fk_colaborador_usuario1_idx", columns={"usuario_idusuario"}), @ORM\Index(name="fk_colaborador_empresa1_idx", columns={"empresa_idempresa"})})
 * @ORM\Entity
 */
class Colaborador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcolaborador", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcolaborador;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="puesto", type="string", length=45, nullable=true)
     */
    private $puesto;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado;

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
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_idusuario", referencedColumnName="idusuario")
     * })
     */
    private $usuariousuario;



    /**
     * Get idcolaborador
     *
     * @return integer
     */
    public function getIdcolaborador()
    {
        return $this->idcolaborador;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Colaborador
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
     * Set puesto
     *
     * @param string $puesto
     *
     * @return Colaborador
     */
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;

        return $this;
    }

    /**
     * Get puesto
     *
     * @return string
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Colaborador
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set empresaempresa
     *
     * @param \AppBundle\Entity\Empresa $empresaempresa
     *
     * @return Colaborador
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

    /**
     * Set usuariousuario
     *
     * @param \AppBundle\Entity\Usuario $usuariousuario
     *
     * @return Colaborador
     */
    public function setUsuariousuario(\AppBundle\Entity\Usuario $usuariousuario = null)
    {
        $this->usuariousuario = $usuariousuario;

        return $this;
    }

    /**
     * Get usuariousuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuariousuario()
    {
        return $this->usuariousuario;
    }
}
