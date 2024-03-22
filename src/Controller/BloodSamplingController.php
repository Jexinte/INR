<?php

namespace App\Controller;

use App\Entity\BloodSampling;
use App\Form\BloodSamplingType;
use App\Form\SendBloodSamplingType;
use App\Form\UpdateBloodSamplingType;
use App\Repository\BloodSamplingRepository;
use App\Service\AdaptiMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class BloodSamplingController extends AbstractController
{
    #[Route('/creer-prelevement-de-sang', name: 'blood_sampling_get', methods: ['GET'])]
    public function bloodSamplingPage(): Response
    {
        $form = $this->createForm(BloodSamplingType::class);
        return ($this->render('blood_sampling/blood_sampling.twig', [
            'form' => $form
        ]));
    }

    #[Route('/creer-prelevement-de-sang', name: 'blood_sampling_post', methods: ['POST'])]
    public function createBloodSampling(Request $request, BloodSamplingRepository $bloodSamplingRepository): Response
    {
        $form = $this->createForm(BloodSamplingType::class);
        $form->handleRequest($request);
        $response = new Response();
        if ($form->isSubmitted() && $form->isValid()) {
            $bloodSampling = $form->getData();
            $bloodSamplingRepository->getEm()->persist($bloodSampling);
            $bloodSamplingRepository->getEm()->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('blood_sampling/blood_sampling.twig', [
            'form' => $form
        ], $response->setStatusCode(Response::HTTP_BAD_REQUEST));
    }

    #[Route('/envoi-prelevement-de-sang', name: 'send_blood_sampling_get', methods: ['GET'])]
    public function sendBloodSamplingPage(): Response
    {
        $form = $this->createForm(SendBloodSamplingType::class);
        return ($this->render('send_blood_sampling/send_blood_sampling.twig', [
            'form' => $form
        ]));
    }

    #[Route('/envoi-prelevement-de-sang', name: 'send_blood_sampling_post', methods: ['POST'])]
    public function sendEmailBloodSampling(Request $request, MailerInterface $mailer, BloodSamplingRepository $bloodSamplingRepository, AdaptiMessage $adaptiMessage, \IntlDateFormatter $dateFormatter): Response
    {
        $form = $this->createForm(SendBloodSamplingType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $receiver = $adaptiMessage->checkReceiver($form->getData()["_select_receiver"]);
            $adaptiMessage->toDoctors($receiver, $bloodSamplingRepository, $mailer, $dateFormatter);
            $this->addFlash("success","L'envoi du mail a été effectué avec succès !");
            return $this->redirectToRoute('homepage');
            }

        return $this->render('send_blood_sampling/send_blood_sampling.twig', [
            'form' => $form
        ]);
    }

    #[Route('/mise-a-jour-prelevement-de-sang/{id}', name: 'update_blood_sampling_get', methods: ['GET'])]
    public function updateBloodSamplingPage(BloodSampling $sampling): Response
    {
        $form = $this->createForm(UpdateBloodSamplingType::class, $sampling);
        return $this->render('update_blood_sampling/update_blood_sampling.twig', [
            'form' => $form,
            'bloodSampling' => $sampling
        ]);
    }

    #[Route('/mise-a-jour-prelevement-de-sang/{id}', name: 'update_blood_sampling_post', methods: ['POST'])]
    public function updateBloodSamplingPost(BloodSamplingRepository $samplingRepository, BloodSampling $sampling, Request $request): Response
    {
        $form = $this->createForm(UpdateBloodSamplingType::class, $sampling);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $samplingRepository->getEm()->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('update_blood_sampling/update_blood_sampling.twig', [
            'form' => $form,
            'bloodSampling', $sampling
        ]);
    }

}
