<?php

namespace App\Entity;

use App\Repository\BloodSamplingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[\AllowDynamicProperties]
#[ORM\Entity(repositoryClass: BloodSamplingRepository::class)]
class BloodSampling
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotNull(message:'Veuillez sélectionner une date de prélèvement !')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:'Veuillez spécifier la dose journalière avant que la prise de sang n\'est été effectuée !')]
    private ?string $dailyDoseBeforeBloodTest = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:'Veuillez spécifier l\'inr !')]
    private ?float $inr = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:'Veuillez spécifier la dose journalière modifiée après INR !')]
    private ?string $dailyDoseModifiedAfterInr = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'Veuillez spécifier les remarques éventuelles !')]
    private ?string $anyComments = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message:'Veuillez spécifier la date du prochain INR !')]
    private ?\DateTimeInterface $dateOfNextInr = null;

    #[ORM\Column]
    private ?bool $isSend = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDailyDoseBeforeBloodTest(): ?string
    {
        return $this->dailyDoseBeforeBloodTest;
    }

    public function setDailyDoseBeforeBloodTest(?string $dailyDoseBeforeBloodTest): static
    {
        $this->dailyDoseBeforeBloodTest = $dailyDoseBeforeBloodTest;

        return $this;
    }

    public function getInr(): ?float
    {
        return $this->inr;
    }

    public function setInr(float $inr): static
    {
        $this->inr = $inr;

        return $this;
    }

    public function getDailyDoseModifiedAfterInr(): ?string
    {
        return $this->dailyDoseModifiedAfterInr;
    }

    public function setDailyDoseModifiedAfterInr(?string $dailyDoseModifiedAfterInr): static
    {
        $this->dailyDoseModifiedAfterInr = $dailyDoseModifiedAfterInr;

        return $this;
    }

    public function getAnyComments(): ?string
    {
        return $this->anyComments;
    }

    public function setAnyComments(string $anyComments): static
    {
        $this->anyComments = $anyComments;

        return $this;
    }

    public function getDateOfNextInr(): ?\DateTimeInterface
    {
        return $this->dateOfNextInr;
    }

    public function setDateOfNextInr(?\DateTimeInterface $dateOfNextInr): static
    {
        $this->dateOfNextInr = $dateOfNextInr;

        return $this;
    }

    public function isIsSend(): ?bool
    {
        return $this->isSend;
    }

    public function setIsSend(bool $isSend): static
    {
        $this->isSend = $isSend;

        return $this;
    }
}
