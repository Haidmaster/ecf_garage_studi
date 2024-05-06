<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Model;
use App\Entity\Energy;
use App\Entity\Gearbox;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('model', EntityType::class, [
                'class' => Model::class,
                'choice_label' => 'name',
                'label' => 'Selectionnez un modèle',
                'group_by' => 'brand.name',
            ])
            ->add('energy', EntityType::class, [
                'label'     => 'Carburant',
                'class'         => Energy::class,
                'choice_label'  => 'name',
                'mapped'        => true,
                'placeholder'   => 'Choisir le carburant',
                'multiple'      => false,
            ])
            ->add('gearbox', EntityType::class, [
                'label'     => 'Boite de vitesse',
                'class'         => Gearbox::class,
                'choice_label'  => 'name',
                'mapped'        => true,
                'placeholder'   => 'Choisir la boite de vitesse',
                'multiple'      => false,
            ])
            ->add('years', IntegerType::class, [
                'label' => 'Année',
                'attr' => ['placeholder' => 'Saisir l\'année du véhicule']

            ])
            ->add(
                'mileage',
                IntegerType::class,
                [
                    'label' => 'Kilométrage'
                ]
            )
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
            ])
            ->add('options', TextareaType::class, [
                'label' => 'Equipements et options',
                'attr' => ['placeholder' => 'Caméra de recul,ouverture sans clés,etc..']

            ])

            ->add('images', FileType::class, [
                'label' => 'Selectionnez une ou plusieurs photos',
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
