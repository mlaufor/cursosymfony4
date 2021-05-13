<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Entity\Usuario;

/**
* @Route("/users")
*/

class UsuarioController extends AbstractController{

    /**
     * @Route("/alta", name="altausuario")
     */
    public function altaUsuario(Request $request){

               
        $email = $request->get("email");
        //$nombre = $request->get("nombre");
        echo "<pre>"; print_r($email); echo "</pre>";

        die;
        //$email = $paramFetcher->get('email');
        
        $em = $this->getDoctrine()->getManager();
        try{
            $usuario =  new Usuario("Matias","Miletich","mmatiasmiletich.informatica@gmail.com","27858264");
            echo "<pre>"; print_r($usuario); echo "</pre>";
            $em->persist($usuario);
            $em->flush();       
        }catch(\Exception $e){
           
        }

        //$usuarios = $em->getRepository(Usuario::class)->findAll();
        $em = $this->getDoctrine()->getManager();
        $nuevousuario = $em->getRepository(Usuario::class)->findOneBy(["id" => $usuario->getId()]);       
        echo "<pre>"; print_r($nuevousuario); echo "</pre>";
        return $this->render('user/alta_usuario.html.twig');
      
    }
    /**
     * @Route("/lista",name="lista_usuarios")
     */
    public function listaUsuarios(Request $request){

        $em = $this->getDoctrine()->getManager();

        $listaUsuarios = $em->getRepository(Usuario::class)->findAll(); //Me traigo todos los usuarios
        
        //LISTAR TODOS USUARIO


        $usuario = $em->getRepository(Usuario::class)->findByNombre('Carlin'); //Me traigo al usuario con nombre Carlin
        return $this->render('user/lista_usuarios.html.twig',["users" => $listaUsuarios]);
        
    }

    /**
     * @Route("/update",name="update_usuario")
    */
    public function updateUsuario(Request $request) 
    {
        
        $em = $this->getDoctrine()->getManager();
        //$usuario = $em->getRepository(Usuario::class)->findOneBy(["id" => $request->get("id")]); 
        $email = "abril@hotmail.com";
        $usuario = $em->getRepository(Usuario::class)->findOneBy(["id" => 1]);
        $usuario->setNombre("Jorge");
        $usuario->setEmail($email);
        $em->flush();
        
        return $this->render('home/index.html.twig',["nombre"=>$usuario->getNombre(),"valor"=>1]);

    }

     /**
     * @Route("/validarusuario",name="validarusuario")
     */
    public function validarUsuario(Request $request){
        
        $em = $this->getDoctrine()->getManager();
        $email = $request->get("email");
        echo "<pre>"; print_r($email); echo "</pre>";
        $usuario = $em->getRepository(Usuario::class)->findByEmail($email);
        echo "<pre>"; print_r($usuario); echo "</pre>";
        if($usuario){
          // $nombre = $usuario->getNombre();
           //echo $nombre;
           return $this->render('home/index.html.twig',["usuario"=>$usuario,"email"=>$email,"valor"=>2]);
           //return $this->render('home/index.html.twig',["email"=>$email,"valor"=>2]);
        }
        else {
           return $this->render('home/index.html.twig',["valor"=>3 ]);
        }
          
        
    }

}

