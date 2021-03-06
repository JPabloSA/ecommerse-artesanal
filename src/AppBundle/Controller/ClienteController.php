<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Colaborador;
use AppBundle\Entity\Empresa;
use AppBundle\Entity\Cliente;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Pedido;
use AppBundle\Entity\Detallepedido;

class ClienteController extends Controller
{
    
    private $session;

    public function __construct(){
      header("Access-Control-Allow-Origin:*");
      header("Access-Control-Allow-Methods:*");
      $this->session = new Session();
    }

	public function notificacion($tipo, $mensaje){
      $this->session->getFlashBag()->add($tipo, $mensaje);
  }


  public function registroClienteAction(Request $request){
    
        
    return $this->render('cliente/registroCliente.html.twig');
  }

  public function guardarClienteAction(Request $request){
    $em = $this->getDoctrine()->getManager();

    $email=$request->request->get('email');
    $password=$request->request->get('pass');
    $nombres=$request->request->get('nombres');
    $apellidos=$request->request->get('apellidos');
    $direccion=$request->request->get('direccion');
    $nit=$request->request->get('nit');
    $telefono=$request->request->get('telefono');

    $usuario=new Usuario();
    $opciones = ['cost' => 4,];
    $usuario->setUsername($email);
    $usuario->setPassword(password_hash($password, PASSWORD_BCRYPT, $opciones));
    $usuario->setRol("Cliente");
    $usuario->setEstado(1);
    $em->persist($usuario);
    $em->flush();


    $cliente=new Cliente();
    $cliente->setUsuariousuario($usuario);
    $cliente->setNombre($nombres);
    $cliente->setApellido($apellidos);
    $cliente->setDireccion($direccion);
    $cliente->setNit($nit);
    $cliente->setTelefono($telefono);
    $em->persist($cliente);
    $em->flush();

    return new Response("hecho");
    //return $this->redirectToRoute('login');
  }

  public function solicitarPedidoAction(Request $request){
    $id=$request->request->get("id");
    $tipo=$request->request->get("tipo");
    $envio=$request->request->get("envio");
    $em = $this->getDoctrine()->getManager();

    $pedido=$this->getDoctrine()->getRepository(Pedido::class)->findOneByIdpedido($id);

    $pedido->setEnvio($envio);
    $pedido->setTipopago($tipo);
    $pedido->setEstado(1);
    $em->flush();

    return new Response("pedido solicitado");
    
  }

  public function cancelarPedidoAction(Request $request){
    $id=$request->request->get("id");
    $em = $this->getDoctrine()->getManager();

    $pedido=$this->getDoctrine()->getRepository(Pedido::class)->findOneByIdpedido($id);

    $detalles=$this->getDoctrine()->getRepository(Detallepedido::class)->findByPedidopedido($pedido);
    
    foreach ($detalles as $detalle) {
      $em->remove($detalle);
      $em->flush();
    }

    $em->remove($pedido);
    $em->flush();

    return new Response("Pedido cancelado");
  }

  public function misPedidosAction(Request $request){
    $user = $this->get('security.token_storage')->getToken()->getUser();
    $cliente=$this->getDoctrine()->getRepository(Cliente::class)->findOneByUsuariousuario($user);

    $pedidos=$this->getDoctrine()->getRepository(Pedido::class)->findBy(array('clientecliente'=>$cliente,'estado'=>1));

    return $this->render('cliente/misPedidos.html.twig',array(
      'pedidos'=>$pedidos
    ));
  }

  public function detallePedidohechoAction(Request $request){
    $id=$request->request->get("id");
    $pedido=$this->getDoctrine()->getRepository(Pedido::class)->findOneByIdpedido($id);
    $detalles=$this->getDoctrine()->getRepository(Detallepedido::class)->findByPedidopedido($pedido);

    return $this->render('cliente/detallePedidohecho.html.twig',array(
      'pedido'=>$pedido,
      'detalles'=>$detalles
    ));
   
 
  }



  




    
    

    
}
