<?php

namespace App\Service;

use App\Repository\BloodSamplingRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AdaptiMessage
{

    public function toDoctors(string $receiver, BloodSamplingRepository $samplingRepository, MailerInterface $mailer, \IntlDateFormatter $dateFormatter): void
    {
        $sender = json_decode(file_get_contents('../config/sender.json'),true);
        $email = (new Email())
            ->from($sender["email"])
            ->to($receiver)
            ->subject('INR')
            ->text(body: "{$this->welcomeMessage($receiver)}, \n
Voici le résultat de l'INR ci-contre avec les 2 derniers résultats  : \n\n" .
                ucfirst($dateFormatter->format($this->getTheLastThreeBloodSamples($samplingRepository)["lastSample"]->getCreatedAt())) . " - INR " . $this->getTheLastThreeBloodSamples($samplingRepository)["lastSample"]->getInr() . " - " . "Coumadine - " . $this->getTheLastThreeBloodSamples($samplingRepository)["lastSample"]->getDailyDoseBeforeBloodTest() . "\n\n" .
                ucfirst($dateFormatter->format($this->getTheLastThreeBloodSamples($samplingRepository)['beforeLast']->getCreatedAt())) . " - INR " . $this->getTheLastThreeBloodSamples($samplingRepository)['beforeLast']->getInr() . " - " . "Coumadine - " . $this->getTheLastThreeBloodSamples($samplingRepository)['beforeLast']->getDailyDoseBeforeBloodTest() . "\n\n" .
                ucfirst($dateFormatter->format($this->getTheLastThreeBloodSamples($samplingRepository)["beforeBeforeLast"]->getCreatedAt())) . " - INR " . $this->getTheLastThreeBloodSamples($samplingRepository)["beforeBeforeLast"]->getInr() . " - " . "Coumadine - " . $this->getTheLastThreeBloodSamples($samplingRepository)["beforeBeforeLast"]->getDailyDoseBeforeBloodTest() . "\n\n" .
                "Cordialement  \n 
Mamadou D.D
");

        $mailer->send($email);
    }

public function welcomeMessage($name):?string

{
    $doctorsName = array_flip(json_decode(file_get_contents('../config/doctors.json'),true));
    return "Bonjour ".$doctorsName[$name];
}
    
    public function getTheLastThreeBloodSamples(BloodSamplingRepository $samplingRepository) :array
    {
        return [
            "beforeBeforeLast" => $samplingRepository->findAll()[count($samplingRepository->findAll()) - 3],
            "beforeLast" => $samplingRepository->findAll()[count($samplingRepository->findAll()) - 2],
            "lastSample" => $samplingRepository->findAll()[count($samplingRepository->findAll()) - 1]
        ];
    }

    public function checkReceiver(string $receiver):?string
    {
        $doctorsEmails = json_decode(file_get_contents('../config/doctors.json'),true);
        return in_array($receiver,$doctorsEmails) ? $receiver:null;
    }

}