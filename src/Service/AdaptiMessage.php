<?php

namespace App\Service;

use App\Repository\BloodSamplingRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AdaptiMessage {
    public function toBeyler(string $receiver , BloodSamplingRepository $samplingRepository,MailerInterface $mailer) :void
    {
        $email = (new Email())
            ->from('mdembelepro@gmail.com')
            ->to($receiver)
            ->subject('INR')
            ->text(body:
"Bonjour,\n"." 
Le résultat est à ".$samplingRepository->findAll()[count($samplingRepository->findAll()) - 1]->getInr().". \n\n".
"Pour rappel la dose de coumadine est à ".$samplingRepository->findAll()[count($samplingRepository->findAll()) - 1]->getDailyDoseBeforeBloodTest()."mg \n
Cordialement , \n
Mamadou D.D
               ");
        $mailer->send($email);
    }
    public function toEgraz(string $receiver , BloodSamplingRepository $samplingRepository,MailerInterface $mailer,\IntlDateFormatter $dateFormatter) :void
    {
        $beforeBeforeLast = $samplingRepository->findAll()[count($samplingRepository->findAll()) - 3];
        $beforeLast = $samplingRepository->findAll()[count($samplingRepository->findAll()) - 2];
        $lastSample = $samplingRepository->findAll()[count($samplingRepository->findAll()) - 1];

        $email = (new Email())
            ->from('mdembelepro@gmail.com')
            ->to($receiver)
            ->subject('INR')
            ->text(body:
"Bonjour, \n
Le Dr Beyler m'ayant redirigé vers vous pour avoir un retour sur le dernier INR, je vous mets ci-contre les 3 derniers résultats  : \n\n".
ucfirst($dateFormatter->format($beforeBeforeLast->getCreatedAt()))." - INR ".$beforeBeforeLast->getInr()." - "."Coumadine ".$beforeBeforeLast->getDailyDoseBeforeBloodTest()."\n\n".
ucfirst($dateFormatter->format($beforeLast->getCreatedAt()))." - INR ".$beforeLast->getInr()." - "."Coumadine ".$beforeLast->getDailyDoseBeforeBloodTest()."\n\n".
ucfirst($dateFormatter->format($lastSample->getCreatedAt()))." - INR ".$lastSample->getInr()." - "."Coumadine ".$lastSample->getDailyDoseBeforeBloodTest()."\n\n".
" Cordialement  \n 
Mamadou D.D
");
        
        $mailer->send($email);
    }
    public function toBonnefoy(string $receiver , BloodSamplingRepository $samplingRepository,MailerInterface $mailer,\IntlDateFormatter $dateFormatter) :void
    {
        $beforeBeforeLast = $samplingRepository->findAll()[count($samplingRepository->findAll()) - 3];
        $beforeLast = $samplingRepository->findAll()[count($samplingRepository->findAll()) - 2];
        $lastSample = $samplingRepository->findAll()[count($samplingRepository->findAll()) - 1];

        $email = (new Email())
            ->from('mdembelepro@gmail.com')
            ->to($receiver)
            ->subject('INR')
            ->text(body:
"Bonjour, \n
Le Dr Beyler m'ayant redirigé vers vous pour avoir un retour sur le dernier INR, je vous mets ci-contre les 3 derniers résultats  : \n\n".
ucfirst($dateFormatter->format($beforeBeforeLast->getCreatedAt()))." - INR ".$beforeBeforeLast->getInr()." - "."Coumadine ".$beforeBeforeLast->getDailyDoseBeforeBloodTest()."\n\n".
ucfirst($dateFormatter->format($beforeLast->getCreatedAt()))." - INR ".$beforeLast->getInr()." - "."Coumadine ".$beforeLast->getDailyDoseBeforeBloodTest()."\n\n".
ucfirst($dateFormatter->format($lastSample->getCreatedAt()))." - INR ".$lastSample->getInr()." - "."Coumadine ".$lastSample->getDailyDoseBeforeBloodTest()."\n\n".
" Cordialement  \n 
Mamadou D.D
");

        $mailer->send($email);
    }


}