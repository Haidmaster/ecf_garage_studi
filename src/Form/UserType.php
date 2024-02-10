<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
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
                'label' => 'Selectionnez le rôle',
                'entry_type' => ChoiceType::class,
                'choices' => [
                    [
                        'Aministrateur' => 'ROLE_ADMIN',
                        'Employé' => 'ROLE_EMPLOYEE'
                    ]
                ]
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
