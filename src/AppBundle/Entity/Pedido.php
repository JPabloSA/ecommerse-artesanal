<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido", indexes={@ORM\Index(name="fk_pedido_empresa1_idx", columns={"empresa_idempresa"}), @ORM\Index(name="fk_pedido_cliente1_idx", columns={"cliente_idcliente"})})
 * @ORM\Entity
 */
class Pedido
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpedido", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpedido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float", precision=10, scale=0, nullable=true)
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(name="envio", type="string", length=200, nullable=true)
     */
    private $envio;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="codigopedido", type="string", length=100, nullable=true)
     */
    private $codigopedido;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipopago", type="integer", nullable=true)
     */
    private $tipopago;

    /**
     * @var string
     *
     * @ORM\Column(name="boleta", type="string", length=80, nullable=true)
     */
    private $boleta;

    /**
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_idcliente", referencedColumnName="idcliente")
     * })
     */
    private $clientecliente;

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
     * Get idpedido
     *
     * @return integer
     */
    public function getIdpedido()
    {
        return $this->idpedido;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Pedido
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set total
     *
     * @param float $total
     *
     * @return Pedido
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set envio
     *
     * @param string $envio
     *
     * @return Pedido
     */
    public function setEnvio($envio)
    {
        $this->envio = $envio;

        return $this;
    }

    /**
     * Get envio
     *
     * @return string
     */
    public function getEnvio()
    {
        return $this->envio;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Pedido
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
     * Set codigopedido
     *
     * @param string $codigopedido
     *
     * @return Pedido
     */
    public function setCodigopedido($codigopedido)
    {
        $this->codigopedido = $codigopedido;

        return $this;
    }

    /**
     * Get codigopedido
     *
     * @return string
     */
    public function getCodigopedido()
    {
        return $this->codigopedido;
    }

    /**
     * Set tipopago
     *
     * @param integer $tipopago
     *
     * @return Pedido
     */
    public function setTipopago($tipopago)
    {
        $this->tipopago = $tipopago;

        return $this;
    }

    /**
     * Get tipopago
     *
     * @return integer
     */
    public function getTipopago()
    {
        return $this->tipopago;
    }

    /**
     * Set boleta
     *
     * @param string $boleta
     *
     * @return Pedido
     */
    public function setBoleta($boleta)
    {
        $this->boleta = $boleta;

        return $this;
    }

    /**
     * Get boleta
     *
     * @return string
     */
    public function getBoleta()
    {
        return $this->boleta;
    }

    /**
     * Set clientecliente
     *
     * @param \AppBundle\Entity\Cliente $clientecliente
     *
     * @return Pedido
     */
    public function setClientecliente(\AppBundle\Entity\Cliente $clientecliente = null)
    {
        $this->clientecliente = $clientecliente;

        return $this;
    }

    /**
     * Get clientecliente
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getClientecliente()
    {
        return $this->clientecliente;
    }

    /**
     * Set empresaempresa
     *
     * @param \AppBundle\Entity\Empresa $empresaempresa
     *
     * @return Pedido
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
