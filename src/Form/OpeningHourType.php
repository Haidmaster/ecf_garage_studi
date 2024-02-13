<?php

namespace App\Form;

use App\Entity\OpeningDay;
use App\Entity\OpeningHour;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpeningHourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', OpeningDay::class, [
                'label'     => 'Jour',
                'class'         => ChoiceType::class,
                'choice_label'  => 'name',
                'choice_value' => 'name',
                'placeholder'   => 'Selectionnez le jour',

            ])

            ->add('openAm', EntityType::class, [
                'label'     => 'Heure d\'ouverture du matin',
                'placeholder'   => 'Selectionnez l\'heure',
                'class'         => OpeningHour::class,
                'choice_label'  => 'openAm',
                'mapped'        => true,
                'multiple'      => false,
            ])
            ->add('closeAm', EntityType::class, [
                'label'     => 'Heure de fermeture matin',
                'placeholder'   => 'Selectionnez l\'heure',
                'class'         => OpeningHour::class,
                'choice_label'  => 'closeAm',
                'mapped'        => true,
                'multiple'      => false,
            ])
            ->add('openPm', EntityType::class, [
                'label'     => 'Heure d\'ouverture après-midi',
                'placeholder'   => 'Selectionnez l\'heure',
                'class'         => OpeningHour::class,
                'choice_label'  => 'openPm',
                'mapped'        => true,
                'multiple'      => false,
            ])
            ->add('closePm', EntityType::class, [
                'label'     => 'Heure de fermeture après-midi',
                'placeholder'   => 'Selectionnez l\'heure',
                'class'         => OpeningHour::class,
                'choice_label'  => 'closePm',
                'mapped'        => true,
                'multiple'      => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OpeningHour::class,
        ]);
    }
}
