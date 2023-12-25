<?php

namespace App\Controller;

use App\Entity\BloodSampling;
use App\Form\BloodSamplingType;
use App\Repository\BloodSamplingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BloodSamplingController extends AbstractController
{
    #[Route('/blood-sampling', name: 'bloodSamplingGet',methods: ['GET'])]
    public function bloodSamplingPage(): Response
    {
        $form = $this->createForm(BloodSamplingType::class);
        return new Response($this->render('blood_sampling/blood_sampling.twig', [
            'form' => $form
        ]));
    }
    #[Route('/blood-sampling', name: 'bloodSamplingPost',methods: ['POST'])]
    public function createBloodSampling(Request $request,BloodSamplingRepository $bloodSamplingRepository): Response
    {
        $form = $this->createForm(BloodSamplingType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $bloodSampling = $form->getData();
            $bloodSamplingRepository->getEm()->persist($bloodSampling);
            $bloodSamplingRepository->getEm()->flush();
            return $this->redirectToRoute('homepage');
        }
        return new Response($this->render('blood_sampling/blood_sampling.twig', [
            'form' => $form
        ]),Response::HTTP_BAD_REQUEST);
    }
}
