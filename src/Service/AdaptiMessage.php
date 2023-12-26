<?php

namespace App\Service;

use App\Repository\BloodSamplingRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AdaptiMessage
{
    public function toBeyler(string $receiver, BloodSamplingRepository $samplingRepository, MailerInterface $mailer): void
    {
        $email = (new Email())
            ->from('mdembelepro@gmail.com')
            ->to("constance.beyler@aphp.fr")
            ->to($receiver)
            ->subject('INR')
            ->text(body: "Bonjour Dr Beyler,\n" . " 
Le résultat est à " . $samplingRepository->findAll()[count($samplingRepository->findAll()) - 1]->getInr() . ". \n\n" .
                "Pour rappel la dose de coumadine est à " . $samplingRepository->findAll()[count($samplingRepository->findAll()) - 1]->getDailyDoseBeforeBloodTest() . "mg \n
Cordialement , \n
Mamadou D.D
               ");
        $mailer->send($email);
    }

    public function toOtherDoctors(string $receiver, BloodSamplingRepository $samplingRepository, MailerInterface $mailer, \IntlDateFormatter $dateFormatter): void
    {
        $politeHello = str_contains($receiver,'mathilde') ? "Bonjour Dr Egraz" : "Bonjour Dr BonneFoy";
        $email = (new Email())
            ->from('mdembelepro@gmail.com')
            ->to($receiver)
            ->subject('INR')
            ->text(body: "$politeHello, \n
Le Dr Beyler m'ayant redirigé vers vous pour avoir un retour sur le dernier INR, je vous mets ci-contre les 3 derniers résultats  : \n\n" .
                ucfirst($dateFormatter->format($this->getTheLastThreeBloodSamples($samplingRepository)["beforeBeforeLast"]->getCreatedAt())) . " - INR " . $this->getTheLastThreeBloodSamples($samplingRepository)["beforeBeforeLast"]->getInr() . " - " . "Coumadine " . $this->getTheLastThreeBloodSamples($samplingRepository)["beforeBeforeLast"]->getDailyDoseBeforeBloodTest() . "\n\n" .
                ucfirst($dateFormatter->format($this->getTheLastThreeBloodSamples($samplingRepository)['beforeLast']->getCreatedAt())) . " - INR " . $this->getTheLastThreeBloodSamples($samplingRepository)['beforeLast']->getInr() . " - " . "Coumadine " . $this->getTheLastThreeBloodSamples($samplingRepository)['beforeLast']->getDailyDoseBeforeBloodTest() . "\n\n" .
                ucfirst($dateFormatter->format($this->getTheLastThreeBloodSamples($samplingRepository)["lastSample"]->getCreatedAt())) . " - INR " . $this->getTheLastThreeBloodSamples($samplingRepository)["lastSample"]->getInr() . " - " . "Coumadine " . $this->getTheLastThreeBloodSamples($samplingRepository)["lastSample"]->getDailyDoseBeforeBloodTest() . "\n\n" .
                " Cordialement  \n 
Mamadou D.D
");

        $mailer->send($email);
    }


    
    public function getTheLastThreeBloodSamples(BloodSamplingRepository $samplingRepository) :array
    {
        return [
            "beforeBeforeLast" => $samplingRepository->findAll()[count($samplingRepository->findAll()) - 3],
            "beforeLast" => $samplingRepository->findAll()[count($samplingRepository->findAll()) - 2],
            "lastSample" => $samplingRepository->findAll()[count($samplingRepository->findAll()) - 1]
        ];
    }


}