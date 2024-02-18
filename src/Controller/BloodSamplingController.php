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
    #[Route('/blood-sampling', name: 'bloodSamplingGet', methods: ['GET'])]
    public function bloodSamplingPage(): Response
    {
        $form = $this->createForm(BloodSamplingType::class);
        return new Response($this->render('blood_sampling/blood_sampling.twig', [
            'form' => $form
        ]));
    }

    #[Route('/blood-sampling', name: 'bloodSamplingPost', methods: ['POST'])]
    public function createBloodSampling(Request $request, BloodSamplingRepository $bloodSamplingRepository): Response
    {
        $form = $this->createForm(BloodSamplingType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $bloodSampling = $form->getData();
            $bloodSamplingRepository->getEm()->persist($bloodSampling);
            $bloodSamplingRepository->getEm()->flush();
            return $this->redirectToRoute('homepage');
        }
        return new Response($this->render('blood_sampling/blood_sampling.twig', [
            'form' => $form
        ]), Response::HTTP_BAD_REQUEST);
    }

    #[Route('/send-blood-sampling', name: 'sendBloodSamplingGet', methods: ['GET'])]
    public function sendBloodSamplingPage(): Response
    {
        $form = $this->createForm(SendBloodSamplingType::class);
        return new Response($this->render('send_blood_sampling/send_blood_sampling.twig', [
            'form' => $form
        ]));
    }

    #[Route('/send-blood-sampling', name: 'sendBloodSamplingPost', methods: ['POST'])]
    public function sendEmailBloodSampling(Request $request, MailerInterface $mailer, BloodSamplingRepository $bloodSamplingRepository, AdaptiMessage $message, \IntlDateFormatter $dateFormatter): Response
    {
        $form = $this->createForm(SendBloodSamplingType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            switch ($form->getData()["_select_receiver"]) {

                case 'constance.beyler@aphp.fr':
                    $message->toBeyler("constance.beyler@aphp.fr", $bloodSamplingRepository, $mailer);
                    break;
                case 'ronan.bonnefoy@aphp.fr':
                    $message->toOtherDoctors('ronan.bonnefoy@aphp.fr', $bloodSamplingRepository, $mailer, $dateFormatter);
                    break;
                case 'mathilde.egraz@aphp.fr':
                    $message->toOtherDoctors('mathilde.egraz@aphp.fr', $bloodSamplingRepository, $mailer, $dateFormatter);
                    break;
                case 'alisson.bertrand@aphp.fr':
                    $message->toOtherDoctors('alisson.bertrand@aphp.fr', $bloodSamplingRepository, $mailer, $dateFormatter);
                    break;
            }
            return $this->redirectToRoute('homepage');
        }
        return new Response($this->render('send_blood_sampling/send_blood_sampling.twig', [
            'form' => $form
        ]));
    }

    #[Route('/update-blood-sampling/{id}', name: 'updateBloodSamplingGet', methods: ['GET'])]
    public function updateBloodSamplingPage(BloodSampling $sampling): Response
    {
        $form = $this->createForm(UpdateBloodSamplingType::class, $sampling);
        return $this->render('update_blood_sampling/update_blood_sampling.twig', [
            'form' => $form,
            'bloodSampling' => $sampling
        ]);
    }

    #[Route('/update-blood-sampling/{id}', name: 'updateBloodSamplingPost', methods: ['POST'])]
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
