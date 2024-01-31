<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Brand;
use App\Entity\Model;
use App\Entity\Energy;
use App\Entity\Gearbox;
use App\Form\BrandType;
use App\Form\ModelType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('model', EntityType::class, [
                'label'     => 'Marque',
                'class'         => Brand::class,  // FQCN de l'entité
                'choice_label'  => 'name', // Attributs de l'entité (ie: colonne de la table)
                'mapped'        => false, // valeur par défaut
                'placeholder'   => 'Choisir la marque',
                'multiple'      => false, //
                'label'     => 'Modèle',
                'class'         => Model::class,  // FQCN de l'entité
                'choice_label'  => 'name', // Attributs de l'entité (ie: colonne de la table)
                'mapped'        => true, // valeur par défaut
                'placeholder'   => 'Choisir un modèle',
                'multiple'      => false, // valeur par défaut. Choix multiple si true (=> checkbox et bouton radio si false)
            ]);
        $builder
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
                'attr' => ['placeholder' => '(Ouverture sans clé,feux xenons,etc..)']

            ])
            ->add('years', IntegerType::class, [
                'label' => 'Année du véhicule',
            ]);

        // ->add('image', FileType)
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
            ModelType::class,
            BrandType::class

        ]);
    }
}
