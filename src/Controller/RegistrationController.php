<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'registration_get',methods: ['GET'])]
    public function registrationPage(): Response
    {
        $form = $this->createForm(RegistrationType::class);
        return $this->render('registration/registration.twig',["form" => $form]);

    }
    #[Route('/registration', name: 'registration_post',methods: ['POST'])]
    public function registration(Request $request,UserRepository $userRepository,UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);
        $response = new  Response();
        if($form->isSubmitted() && $form->isValid())
        {
            $hashPassword = $passwordHasher->hashPassword($user,$user->getPassword());
            $user->setRoles(['ROLE_USER']);
            $userRepository->upgradePassword($user,$hashPassword);
            return $this->redirectToRoute('login_get');
        }
        return $this->render('registration/registration.twig',["form" => $form],$response->setStatusCode(Response::HTTP_BAD_REQUEST));

    }
}
