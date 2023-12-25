<?php

namespace App\Controller;

use App\Repository\BloodSamplingRepository;
use IntlDateFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class HomepageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(BloodSamplingRepository $bloodSamplingRepository, IntlDateFormatter $dateFormatter): Response
    {
        foreach($bloodSamplingRepository->findAll() as  $k => $bloodSampling)
        {
            $bloodSamplingRepository->findAll()[$k]->frenchDate = ucfirst($dateFormatter->format($bloodSampling->getCreatedAt()));
            $bloodSamplingRepository->findAll()[$k]->nextDateInr = ucfirst($dateFormatter->format($bloodSampling->getDateOfNextInr()));
        }
       return new Response($this->render('homepage/homepage.twig',[
           'bloodSamplingResults' => $bloodSamplingRepository->findAll(),
       ]));
    }
}
