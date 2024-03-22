<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SendBloodSamplingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $doctorsEmails = json_decode(file_get_contents('../config/doctors.json'),true);
        $doctorsName = array_flip(json_decode(file_get_contents('../config/doctors.json'),true));
        $builder
            ->add('_select_receiver',ChoiceType::class,[
                'label' => 'Sélectionner un destinataire' ,
                'choices' => [
                    current($doctorsName) => current($doctorsEmails),
                    next($doctorsName) => next($doctorsEmails),
                    next($doctorsName) => next($doctorsEmails),
                    next($doctorsName) => next($doctorsEmails),
                ],
                'constraints' => [
                    new NotBlank(message:'Merci de séléctionner un destinaire !')
                ],
                'required' => false
            ])

            ->add('save',SubmitType::class,[
                'label' => 'Envoyer' ,
                    'attr' =>
                    ['class' => 'btn btn-dark']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
