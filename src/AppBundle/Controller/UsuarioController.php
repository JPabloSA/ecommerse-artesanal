<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Colaborador;
use AppBundle\Entity\Empresa;

class UsuarioController extends Controller
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
    
    public function loginAction()
    {

    	 //Llamamos al servicio de autenticacion
    	$authenticationUtils = $this->get('security.authentication_utils');

    	// conseguir el error del login si falla
    	$error = $authenticationUtils->getLastAuthenticationError();

    	// ultimo nombre de usuario que se ha intentado identificar
    	$lastUsername = $authenticationUtils->getLastUsername();

    	$u=$this->getUser();

    	if($u!=null){

            $role=$u->getRol();
            $estado=$u->getEstado();
            if ($estado==1) {
                if ($role =="Empresa") {

                    $colaborador = $this->getDoctrine()->getRepository(Colaborador::class)->findOneByUsuariousuario($u);
                    $puesto=$colaborador->getPuesto();
                    $empresa=$colaborador->getEmpresaempresa();
                        
                    if ($puesto == "Gerente") {
                        return $this->redirectToRoute("gerentePage");
                    }
                    if ($puesto == "Recepcion") {
                        return $this->redirectToRoute("recepcionPage");                            
                    }
                    if ($puesto == "Bodega") {
                        return $this->redirectToRoute("bodegaPage");
                    }
                    if ($puesto == "Produccion") {
                        return $this->redirectToRoute("produccionPage");
                    }
                }
                if ($role == "Cliente") {
                    return $this->redirectToRoute('principal');
                }
                //$this->notificacion("error", "Se encontro usuario pero no colaborador");
            }
            

    	}else{
            //$this->notificacion("error","no hay usuario");
    		return $this->render('inicio/empresaLogin.html.twig');
    	}
        // replace this example code with whatever you need
        return $this->render('inicio/empresaLogin.html.twig');
    }
    
}
