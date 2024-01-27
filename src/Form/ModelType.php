<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Model;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', EntityType::class, [
                'label'     => 'Liste',
                'class'         => Brand::class,  // FQCN de l'entité
                'choice_label'  => 'name', // Attributs de l'entité (ie: colonne de la table)
                'mapped'        => true, // valeur par défaut
                'placeholder'   => 'Choisir une marque',
                'expanded'      => false, // valeur par défaut. Checkox ou radio si true
                'multiple'      => false, // valeur par défaut. Choix multiple si true (=> checkbox et bouton radio si false)
            ])
            ->add('name', TextType::class, [
                'label' => 'Modèle',
                'attr' => [
                    'placeholder' => 'Saisir un modèle'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Model::class,
        ]);
    }
}
