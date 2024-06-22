<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => true,
                'invalid_message' => 'Le mot de passe ne correspond pas.',
                'label' => 'Votre nouveau mot de passe',

                'required' => true,
                'first_options'  => [
                    'label' => 'Votre nouveau mot de passe',
                    'attr' => ['placeholder' => 'Saisir un nouveau mot de passe']
                ],
                'second_options' => [
                    'label' => 'Confirmer votre mot de passe',
                    'attr' => ['placeholder' => 'Saisir à nouveau votre mot de passe']
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Validez pour accepter'
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
