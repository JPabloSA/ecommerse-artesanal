<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdministradorController extends Controller
{
    
    public function homeAdministradorAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('administrador/administradorPage.html.twig');
    }
    

    
}
