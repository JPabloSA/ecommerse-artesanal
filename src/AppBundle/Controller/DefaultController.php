<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Producto;
use AppBundle\Entity\Empresa;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Pedido;
use AppBundle\Entity\Detallepedido;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        return $this->render('default/index.html.twig');
    }

    public function listaEmpresasAction(){
      
      $empresas = $this->getDoctrine()->getRepository(Empresa::class)->findAll();

      return $this->render('default/listaEmpresas.html.twig',array('empresas'=>$empresas )); 
    }

    public function empresaPageAction(Request $request){
      $id=$request->request->get("id");
      $empresa = $this->getDoctrine()->getRepository(Empresa::class)->findOneByIdempresa($id);

      return $this->render('default/empresaPage.html.twig',array(
        'empresa'=>$empresa
      ));

    }

    public function catalogoGeneralAction(Request $request){
        $id=$request->request->get("id");
        $empresa = $this->getDoctrine()->getRepository(Empresa::class)->findOneByIdempresa($id);
        $categorias = $this->getDoctrine()->getRepository(Categoria::class)->findByEmpresaempresa($empresa);
        $productos = array();


        foreach ($categorias as $categoria) {
          $prods = $this->getDoctrine()->getRepository(Producto::class)->findByCategoriacategoria($categoria);
          foreach ($prods as $prod) {
            array_push($productos,$prod);
          }
          
        }

        return $this->render('default/catalogoGeneral.html.twig',array(
          'empresa' => $empresa,
          'productos' => $productos,
          'categorias' => $categorias
        ));
    }

//vista del detalle de compras
    public function carroVistaAction(Request $request){
      $id=$request->request->get("id");
      $empresa = $this->getDoctrine()->getRepository(Empresa::class)->findOneByIdempresa($id);
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $cliente = $this->getDoctrine()->getRepository(Cliente::class)->findOneByUsuariousuario($user);
      
      //$pedido = $this->getDoctrine()->getRepository(Pedido::class)->findOneBy(array('clientecliente'=>$cliente));

      $repository = $this->getDoctrine()->getRepository(Pedido::class);

      $query = $repository->createQueryBuilder('p')
          ->where('p.clientecliente = :cliente')
          ->andWhere('p.empresaempresa = :empresa')
          ->setParameter('cliente',$cliente)
          ->setParameter('empresa', $empresa)
          ->setMaxResults(1)
          ->getQuery();

      $pedido = $query->getResult();
      $cantpedido=count($pedido);
      
      /*$pedido=new Pedido();
      foreach ($pedidos as $ped) {
        $pedido=$ped;
      }*/
      
      $detalle = $this->getDoctrine()->getRepository(Detallepedido::class)->findByPedidopedido($pedido);  
      
      
//envio detalle para mostrar y cliente para mostrar sus datos
      return $this->render('default/carrito.html.twig',array(
        'empresa'=>$empresa,
        'pedido'=>$pedido,
        'cantpedido'=>$cantpedido,
        'detalles'=>$detalle, 
        'cliente'=>$cliente));
    }

    public function carroAction(Request $request)
    {
      $id=$request->request->get("id");
      $cantidad=$request->request->get("cantidad");
      $id2=$request->request->get("id2");
      $user = $this->get('security.token_storage')->getToken()->getUser();
      $cliente = $this->getDoctrine()->getRepository(Cliente::class)->findOneByUsuariousuario($user);
      $empresa = $this->getDoctrine()->getRepository(Empresa::class)->findOneByIdempresa($id);

      $pedidos = $this->getDoctrine()->getRepository(Pedido::class)->findOneByclientecliente($cliente);
//chequea si existe un pedido hecho por el cliente logueado
//si ni existe lo crea y crea tambien el primer detalle
      if (!$pedidos) {
        $entityManager = $this->getDoctrine()->getManager();
              $pedido = new Pedido();
              $pedido->setFecha($this->updated = new \DateTime("now"));
              $pedido->setTotal(0);
              $pedido->setEnvio('pendiente');
              $pedido->setEstado(0);
              $pedido->setEmpresaempresa($empresa);
              $pedido->setClientecliente($cliente);
              $pedido->setCodigopedido(1);
                // tell Doctrine you want to (eventually) save the Product (no queries yet)
              $entityManager->persist($pedido);
              $entityManager->flush();
//vuelve a buscar los datos del pedido que se agrego a la BD para mandarselo a detalle
              $productoD = $this->getDoctrine()->getRepository(Producto::class)->findOneByIdproducto($id2);
              $pedidoRefresh = $this->getDoctrine()->getRepository(Pedido::class)->findOneByclientecliente($cliente);

                    $detallepedido = new Detallepedido();
                    $detallepedido->setPedidopedido($pedidoRefresh);
                    $detallepedido->setProductoproducto($productoD);
                    $detallepedido->setCantidad($cantidad);
                    $detallepedido->setTotal($productoD->getPrecio()*$cantidad);
                      // tell Doctrine you want to (eventually) save the Product (no queries yet)
                    $entityManager->persist($detallepedido);
                    $entityManager->flush();
      }
      //si esta creadao y estado es 0 entonces ya solo envia datos a detalles
      //se va con un solo if
      if ($pedidos) {
      if ($pedidos->getEstado() === 0) {
        $entityManager = $this->getDoctrine()->getManager();
        $productoD = $this->getDoctrine()->getRepository(Producto::class)->find($id2);

              $detallepedido = new Detallepedido();
              $detallepedido->setPedidopedido($pedidos);
              $detallepedido->setProductoproducto($productoD);
              $detallepedido->setCantidad($cantidad);
              $detallepedido->setTotal($productoD->getPrecio()*$cantidad);
                // tell Doctrine you want to (eventually) save the Product (no queries yet)
              $entityManager->persist($detallepedido);
              $entityManager->flush();
      }
    }
    $categoria = $this->getDoctrine()->getRepository(Categoria::class)->findOneByEmpresaempresa($empresa);
     $productos = $this->getDoctrine()->getRepository(Producto::class)->findByCategoriacategoria($categoria);
     return new Response('Producto agregado');
     //return $this->render('default/catalogoGeneral.html.twig',array('empresas'=>$empresa,'productos'=>$productos));
  }

  public function quitarProductoAction(Request $request){
    $id=$request->request->get("id");
    
    $em = $this->getDoctrine()->getManager();
    $detalle = $this->getDoctrine()->getRepository(Detallepedido::class)->findOneByIddetallepedido($id);
    $em->remove($detalle);
    $em->flush();  

    return new Response("hecho");

  }

}
