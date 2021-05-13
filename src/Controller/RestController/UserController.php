<?php

namespace App\Controller\RestController;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Extensions\UserUtilitiesTrait;
use App\Entity\Usuario;

/**
 * @Rest\Route("api/users")
 */

class UserController extends AbstractFOSRestController{

    use UserUtilitiesTrait;

    /**
     * @Rest\Get("/all", name="api_all_users")
     * @return Response
     */
    public function getAllUser(Request $request) {
        
        
        $em = $this->getDoctrine()->getManager();

        //$hola = $this->formatUser();
        $listaUsuarios = $em->getRepository(Usuario::class)->findAll();
        
        
        return $this->handleView($this->view($listaUsuarios,200));
    }

    /**
     * @Rest\Post("/alta",name="api_alta_user")
     * @return Response
     */
    public function altaUser(Request $request){
        $em = $this->getDoctrine()->getManager();

        return $this->handleView($this->view("hola Mundo"));
    } 


}