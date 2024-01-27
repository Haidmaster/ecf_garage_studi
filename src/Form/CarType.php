<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Model;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Collection;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mileage', IntegerType::class, [
                'label' => 'Saisir le kilométrage'
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Saisir un prix'
            ])
            ->add('options', TextareaType::class, [
                'label' => 'Saisir les options'
            ])
            ->add('years', IntegerType::class, [
                'label' => 'Saisir l\'année du véhicule'
            ])
            ->add('gearbox', ChoiceType::class, [
                'label' => 'Boîte de vitesse',
                'choices'  => [
                    'Manuelle' => '1',
                    'Automatique' =>  '2',
                    'Semi-automatique' => '3',
                ],
            ])
            ->add('energy', ChoiceType::class, [
                'label' => 'Energie',
                'choices'  => [
                    'Electrique' => '1',
                    'Hybride' => '2',
                    'Essence' =>  '3',
                    'Diesel' => '4',
                ],
            ])
            // ->add('models', CollectionType::class, [
            //     'label'     => 'Liste',

            // ]);
            ->add('models', EntityType::class, [
                'label'     => 'Liste',
                'class'         => Model::class,  // FQCN de l'entité
                'choice_label'  => 'name', // Attributs de l'entité (ie: colonne de la table)
                'mapped'        => true, // valeur par défaut
                'placeholder'   => 'Choisir un modèle',
                'expanded'      => false, // valeur par défaut. Checkox ou radio si true
                'multiple'      => false, // valeur par défaut. Choix multiple si true (=> checkbox et bouton radio si false)
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
