<?php

namespace App\Form;

use App\Entity\OpeningDay;
use App\Entity\OpeningHour;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class OpeningHourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('openingDays', EntityType::class, [
                'class' => OpeningDay::class,
                'choice_label' => 'name',
                'label' => 'Selectionnez le jour',
                'mapped'        => true,
            ])
            ->add('openAm', ChoiceType::class, [
                'label'     => 'Heure d\'ouverture matin',
                'choices'   => [
                    '9'      => '9',
                    '9.30'       => '9.30',
                    '9.45'   => '9.45',
                    '10'      => '10',
                    '10.30'      => '10.30',
                    '10.45'  => '10.45',
                    '11'      => '11',
                    '11.30'   => '11.30',
                    '11.45'   => '11.45',
                    '12' => '12',
                    '12.15' => '12.15',
                    '12.30' => '12.30',
                ],
                'mapped'        => true,
                'placeholder'   => 'Choisir une heure',
                'expanded'      => false,
                'multiple'      => false,
            ])
            ->add('closeAm', ChoiceType::class, [
                'label'     => 'Heure de fermeture matin',
                'choices'   => [
                    '9'      => '9',
                    '9.30'       => '9.30',
                    '9.45'   => '9.45',
                    '10'      => '10',
                    '10.30'      => '10.30',
                    '10.45'  => '10.45',
                    '11'      => '11',
                    '11.30'   => '11.30',
                    '11.45'   => '11.45',
                    '12' => '12',
                    '12.15' => '12.15',
                    '12.30' => '12.30',
                ],
                'mapped'        => true,
                'placeholder'   => 'Choisir une heure',
                'expanded'      => false,
                'multiple'      => false,
            ])
            ->add('OpenPm', ChoiceType::class, [
                'label'     => 'Heure de d\'ouverture Après-midi',
                'choices'   => [
                    '14'      => '14',
                    '14.30'       =>  '14.30',
                    '14.45'   => '14.45',
                    '15'      => '15',
                    '15.30'      => '15.30',
                    '15.45'  => '15.45',
                    '16'      => '16',
                    '16.30'   =>  '16.30',
                    '16.45'   =>  '16.45',
                    '17' => '17',
                    '17.30' => '17.30',
                    '17.45'   =>  '17.45',
                    '18' => '18',
                    '18.30' => '18.30',
                    '18.45'   =>  '18.45',
                    '19' => '19',
                ],
                'mapped'        => true,
                'placeholder'   => 'Choisir une heure',
                'multiple'      => false,
            ])
            ->add('closePm', ChoiceType::class, [
                'label'     => 'Heure de de fermeture Après-midi',
                'choices'   => [
                    '14'      => '14',
                    '14.30'       =>  '14.30',
                    '14.45'   => '14.45',
                    '15'      => '15',
                    '15.30'      => '15.30',
                    '15.45'  => '15.45',
                    '16'      => '16',
                    '16.30'   =>  '16.30',
                    '16.45'   =>  '16.45',
                    '17' => '17',
                    '17.30' => '17.30',
                    '17.45'   =>  '17.45',
                    '18' => '18',
                    '18.30' => '18.30',
                    '18.45'   =>  '18.45',
                    '19' => '19',
                ],
                'mapped'        => true,
                'placeholder'   => 'Choisir une heure',
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
