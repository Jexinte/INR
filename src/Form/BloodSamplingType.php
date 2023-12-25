<?php

namespace App\Form;

use App\Entity\BloodSampling;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BloodSamplingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('createdAt', DateTimeType::class, [
                'label' => 'Date de prélèvement',
                'required' => false
            ])
            ->add('dailyDoseBeforeBloodTest', NumberType::class, [
                'label' => 'Dose journalière avant la prise de sang',
                'required' => false
            ])
            ->add('inr', NumberType::Class, [
                'label' => 'INR',
                'required' => false
            ])
            ->add('dailyDoseModifiedAfterInr', TextType::class, [
                'label' => 'Dose journalière modifiée après INR ( si nécessaire)',
                'required' => false
            ])
            ->add('anyComments', TextType::class, [
                'label' => 'Remarques éventuelles',
                'required' => false
            ])
            ->add('dateOfNextInr', DateTimeType::class, [
                'label' => 'Date du prochain INR',
                'required' => false
            ])
            ->add('isSend', CheckboxType::class, [
                'label' => 'Est-ce que le résultat à déjà été envoyé',
                'required' => false
            ])
            ->add('save', SubmitType::class, ['label' => 'Envoyer', 'attr' => ['class' => 'btn btn-dark']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BloodSampling::class,
        ]);
    }
}
