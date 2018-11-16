<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Colaborador;
use AppBundle\Entity\Empresa;
use AppBundle\Form\UsuarioType;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Producto;
use AppBundle\Form\ProductoType;
use AppBundle\Form\CategoriaType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;




class GerenteController extends Controller
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


    	return $this->render('gerente/gerentePage.html.twig',array(
    		'colaborador'=> $colaborador,
    		'empresa'=> $empresa
    	));
    }
    
    public function homeGerenteAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('gerente/homeGerente.html.twig');
    }

    public function usuariosEmpresaAction(){

        $empresa=$this->obtenerEmpresa();
        $colaboradores = $this->getDoctrine()->getRepository(Colaborador::class)->findByEmpresaempresa($empresa);

        return $this->render('gerente/usuariosEmpresa.html.twig',array(
            'colaboradores'=>$colaboradores
        ));
    }

    public function nuevousuarioEmpresaAction(){

        return $this->render('gerente/nuevousuarioEmpresa.html.twig');
    }

    //crear usuario para la empresa
    public function guardarusuarioEmpresaAction(Request $request){
      $username=$request->request->get("usuario");
      $password=$request->request->get("pass");
      $nombre=$request->request->get("nombre");
      $puesto=$request->request->get("puesto");

      $salida="";

      if (empty($username)||empty($password)||empty($nombre)   ) {
          $salida="error";
      }else{
          $em = $this->getDoctrine()->getManager();
          $usuario=new Usuario();
          $colaborador=new Colaborador();

          $empresa=$this->obtenerEmpresa();

          $opciones = ['cost' => 4,];
          $usuario->setUsername($username);
          $usuario->setPassword(password_hash($password, PASSWORD_BCRYPT, $opciones));
          $usuario->setRol("Empresa");
          $usuario->setEstado(1);

          $em->persist($usuario);
          $em->flush();

          $colaborador->setNombre($nombre  );
          $colaborador->setPuesto($puesto);
          $colaborador->setUsuariousuario($usuario);
          $colaborador->setEmpresaempresa($empresa);
          $em->persist($colaborador);
          $em->flush();

          $salida="hecho";  
      }

      return new Response($salida);

    }

    public function productosEmpresaAction(){
        $empresa=$this->obtenerEmpresa();
        $categorias = $this->getDoctrine()->getRepository(Categoria::class)->findByEmpresaempresa($empresa);
        $productos=array();
        foreach ($categorias as $categoria) {
            $productosfind = $this->getDoctrine()->getRepository(Producto::class)->findByCategoriacategoria($categoria);
            foreach($productosfind as $prod){
                array_push($productos,$prod);
            }            
        }
        return $this->render('gerente/productosEmpresa.html.twig',array(
            'productos'=>$productos
        ));
    }

    public function seleccioncategoriaEmpresaAction(Request $request){
        $empresa = $this->obtenerEmpresa();
        $categorias = $this->getDoctrine()->getRepository(Categoria::class)->findByEmpresaempresa($empresa);

        return $this->render('gerente/seleccioncategoriaEmpresa.html.twig',array(
            'categorias' => $categorias,
            'empresa' => $empresa
        ));

    }

    public function nuevoproductoEmpresaAction(Request $request,$id){
        if($id=="0"){
            $id=$request->request->get('id');
        }
        $empresa=$this->obtenerEmpresa();
        $categoria = $this->getDoctrine()->getRepository(Categoria::class)->findOneByIdcategoria($id);

        $producto = new Producto();


        $form=$this->createForm(ProductoType::class, $producto);


      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          //$producto=$form->getData();

        // Recogemos el fichero
        $file = $form->get('imgurl')->getData();
        // Sacamos la extensión del fichero
        $ext=$file->guessExtension();
        // Le ponemos un nombre al fichero
        $file_name=time().".".$ext;
         
        // Guardamos el fichero en el directorio uploads que estará en el directorio /web del framework
        $file->move("public/uploads", $file_name);
 
        // Establecemos el nombre de fichero en el atributo de la entidad
        $producto->setImgurl("public/uploads/".$file_name);
        $producto->setCategoriacategoria($categoria);

        $em = $this->getDoctrine()->getManager();
        $em->persist($producto);
        $em->flush();
        $this->notificacion("hecho","Producto ingresado correctamente.");
      }

       return $this->render('gerente/nuevoproductoEmpresa.html.twig',array(
        "form"=>$form->createView(),
        "empresa"=>$this->obtenerEmpresa(),
        'categoria' => $categoria 
        ));

    }

    public function categoriasEmpresaAction(){
        $empresa = $this->obtenerEmpresa();
        $categorias = $this->getDoctrine()->getRepository(Categoria::class)->findByEmpresaempresa($empresa);

        return $this->render('gerente/categoriasEmpresa.html.twig',array(
            'categorias' => $categorias,
            'empresa' => $empresa
        ));
    }

    public function nuevacategoriaEmpresaAction(){
        $empresa = $this->obtenerEmpresa();
    
        $categoria = new Categoria();

        $form=$this->createForm(CategoriaType::class, $categoria);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();
            $this->notificacion("hecho","Categoria creada");
        }

        return $this->render('gerente/nuevacategoriaEmpresa.html.twig',array(
            'form' => $form->createView()   
        ));
    }

    public function ingresosbodegaEmpresaAction(){
        return $this->render('gerente/ingresosbodegaEmpresa.html.twig');
    }
    

    public function ventasEmpresaAction(){
        return $this->render('gerente/ventasEmpresa.html.twig');
    }

    
}
