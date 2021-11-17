<?php

namespace App\Controller;

use App\Security\BackendAuthenticator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\AuthenticatorManager;

class SecurtityController extends AbstractController
{
    /**
     *@Route("login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils):Response
    {

        
       $error=$authenticationUtils->getLastAuthenticationError();
       $lastName=$authenticationUtils->getLastUsername();
      
       return $this->render('security/login.html.twig',['lastusername'=>$lastName,'error'=>$error]);
      
       
    //    return $this->json([
    //     'user' => $this->getUser() ,'roles'=>$this->user->getRoles()]
    // );
    }
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
