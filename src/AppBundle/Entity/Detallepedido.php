<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Detallepedido
 *
 * @ORM\Table(name="detallepedido", indexes={@ORM\Index(name="fk_detallepedido_pedido1_idx", columns={"pedido_idpedido"}), @ORM\Index(name="fk_detallepedido_producto1_idx", columns={"producto_idproducto"})})
 * @ORM\Entity
 */
class Detallepedido
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddetallepedido", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddetallepedido;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="string", length=45, nullable=true)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="total", type="string", length=45, nullable=true)
     */
    private $total;

    /**
     * @var \Pedido
     *
     * @ORM\ManyToOne(targetEntity="Pedido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pedido_idpedido", referencedColumnName="idpedido")
     * })
     */
    private $pedidopedido;

    /**
     * @var \Producto
     *
     * @ORM\ManyToOne(targetEntity="Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="producto_idproducto", referencedColumnName="idproducto")
     * })
     */
    private $productoproducto;



    /**
     * Get iddetallepedido
     *
     * @return integer
     */
    public function getIddetallepedido()
    {
        return $this->iddetallepedido;
    }

    /**
     * Set cantidad
     *
     * @param string $cantidad
     *
     * @return Detallepedido
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set total
     *
     * @param string $total
     *
     * @return Detallepedido
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set pedidopedido
     *
     * @param \AppBundle\Entity\Pedido $pedidopedido
     *
     * @return Detallepedido
     */
    public function setPedidopedido(\AppBundle\Entity\Pedido $pedidopedido = null)
    {
        $this->pedidopedido = $pedidopedido;

        return $this;
    }

    /**
     * Get pedidopedido
     *
     * @return \AppBundle\Entity\Pedido
     */
    public function getPedidopedido()
    {
        return $this->pedidopedido;
    }

    /**
     * Set productoproducto
     *
     * @param \AppBundle\Entity\Producto $productoproducto
     *
     * @return Detallepedido
     */
    public function setProductoproducto(\AppBundle\Entity\Producto $productoproducto = null)
    {
        $this->productoproducto = $productoproducto;

        return $this;
    }

    /**
     * Get productoproducto
     *
     * @return \AppBundle\Entity\Producto
     */
    public function getProductoproducto()
    {
        return $this->productoproducto;
    }
}
