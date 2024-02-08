<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'attr' => [
                    'placeholder' => 'Saisir une adresse email'
                ],
            ])
            ->add('password', RepeatedType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => 'Saisir un mot de passe'
                ],
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe ne correspond pas.',
                'label' => 'Mot de passe',
                'options' => ['attr' => ['class' => 'password-field mt-2']],
                'required' => true,
                'first_options'  => [
                    'label' => 'Mot de passe',
                    'attr' => ['placeholder' => 'Saisir un mot de passe']
                ],
                'second_options' => [
                    'label' => 'Confirmer votre mot de passe',
                    'attr' => ['placeholder' => 'Saisir à nouveau votre mot de passe']
                ]
            ])
            ->add('roles', CollectionType::class, [
                'label' => 'Selectionnez le role',
                'entry_type' => ChoiceType::class,
                'entry_options' => [
                    'choices' => [
                        [
                            'Aministrateur' => 'ROLE_ADMIN',
                            'Employé' => 'ROLE_EMPLOYEE'
                        ]

                    ]
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider pour créer un utilisateur'
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}