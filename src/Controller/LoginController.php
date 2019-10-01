<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
    * @Route("/login", name="login")
    */
   public function login(Request $request, AuthenticationUtils $authenticationUtils) : Response 
   {
          $errors = $authenticationUtils->getLastAuthenticationError();
          $lastUsername = $authenticationUtils->getLastUsername();

         return $this->render('login/login.html.twig', [
               'errors' => $errors,
               'username' => $lastUsername
         ]);
    }
  
    /**
     * @Route("/logout", name="logout")
    */
    public function logout() : Response {}
}
