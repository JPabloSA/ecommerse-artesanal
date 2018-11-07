<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Colaborador;
use AppBundle\Entity\Empresa;

class ProduccionController extends Controller
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


    	return $this->render('produccion/produccionPage.html.twig',array(
    		'colaborador'=> $colaborador,
    		'empresa'=> $empresa
    	));
    }

    public function homeProduccionAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('produccion/homeProuduccion.html.twig');
    }
    

    
}
