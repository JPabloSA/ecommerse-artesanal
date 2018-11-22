<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Colaborador;
use AppBundle\Entity\Empresa;
use AppBundle\Entity\Pedido;
use Proxies\__CG__\AppBundle\Entity\Detallepedido;

class RecepcionController extends Controller
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

    private function obtenerEmpresa(){
        //recuperamos la empresa a la cual se logueo
          $user_auth = $this->get('security.token_storage')->getToken()->getUser();
          $colaborador_auth=$this->getDoctrine()->getRepository(Colaborador::class)->findOneByUsuariousuario($user_auth);
          $empresa=$colaborador_auth->getEmpresaempresa();
          //fin recuperar empresa
          return $empresa;
    }

    public function indexAction(){
    	$user = $this->get('security.token_storage')->getToken()->getUser();
    	$colaborador = $this->getDoctrine()->getRepository(Colaborador::class)->findOneByUsuariousuario($user);
        $empresa=new Empresa();
    	$empresa=$colaborador->getEmpresaempresa();


    	return $this->render('recepcion/recepcionPage.html.twig',array(
    		'colaborador'=> $colaborador,
    		'empresa'=> $empresa
    	));
    }
    
    public function homeRecepcionAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('recepcion/homeRecepcion.html.twig');
    }

    public function pedidosRecepcionAction(){
      $empresa=$this->obtenerEmpresa();
      $pedidos=$this->getDoctrine()->getRepository(Pedido::class)->findBy(array(
        'empresaempresa' => $empresa, 
        'estado' => 1
      ));
      return $this->render('recepcion/pedidosRecepcion.html.twig',array(
        'pedidos' => $pedidos
      ));
    }

    public function detallePedidonuevoAction(Request $request){
      $id=$request->request->get("id");
      $pedido=$this->getDoctrine()->getRepository(Pedido::class)->findOneByIdpedido($id);
      $detalles=$this->getDoctrine()->getRepository(Detallepedido::class)->findByPedidopedido($pedido);
      
      return $this->render('recepcion/detallePedidonuevo.html.twig',array(
        'pedido'=>$pedido,
        'detalles'=>$detalles
      ));
    }

    public function entregasRecepcionAction(){
      $empresa=$this->obtenerEmpresa();
      $pedidos=$this->getDoctrine()->getRepository(Pedido::class)->findBy(array(
        'empresaempresa' => $empresa, 
        'estado' => 3
      ));
      return $this->render('recepcion/entregasRecepcion.html.twig',array(
        'pedidos' => $pedidos,
      ));
    }

    public function bodegaRecepcionAction(){
      return $this->render('recepcion/bodegaRecepcion.html.twig');
    }
    

    
}
