<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', FileType::class, [
                'label' => 'Selectionnez une illustration',
                'multiple' => false,
                'mapped' => false,
                'required' => false

            ])
            ->add('name', TextType::class, [
                'label' => 'Titre de la prestation',
                'attr' =>  ['placeholder' => 'Saisir le titre de la prestation']
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Description',
                // 'attr' => ['placeholder' => 'Saisir la description']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
