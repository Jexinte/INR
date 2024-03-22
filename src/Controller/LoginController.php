<?php

namespace App\Controller;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $form = $this->createForm(LoginType::class);
        $response = new Response();
        if($authenticationUtils->getLastAuthenticationError())
        {
            $error = new FormError('Identifiant ou mot de passe incorrect !');
            $usernameField = $form->get('username');
            $usernameField->addError($error);

            return $this->render('login/login.twig',["form" => $form],$response->setStatusCode(Response::HTTP_BAD_REQUEST));
        }
        return $this->render('login/login.twig',["form" => $form]);

    }

}
