<?php

namespace App\Controller;

use App\Form\BloodSamplingType;
use App\Form\SendBloodSamplingType;
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
            }
            return $this->redirectToRoute('homepage');
        }
        return new Response($this->render('send_blood_sampling/send_blood_sampling.twig', [
            'form' => $form
        ]));
    }

}
