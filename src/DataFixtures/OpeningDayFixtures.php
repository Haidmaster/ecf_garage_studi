<?php

namespace App\DataFixtures;

use App\Entity\OpeningDay;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class OpeningDayFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        /*********  DAYS FIXTURES  *********/

        $days =
            [
                'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'
            ];

        foreach ($days as $day) {
            $dayEntity = new OpeningDay();
            $dayEntity->setName($day);
            $manager->persist($dayEntity);
        }
        /*********  HOURS FIXTURES  *********/

        $openHourAm =
            [
                'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'
            ];
        $openHourAm =
            [
                'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'
            ];
        $openHourAm =
            [
                'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'
            ];
        $openHourAm =
            [
                'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'
            ];
        $closed =
            [
                'Fermé'
            ];

        foreach ($days as $day) {
            $dayEntity = new OpeningDay();
            $dayEntity->setName($day);
            $manager->persist($dayEntity);
        }
        foreach ($days as $day) {
            $dayEntity = new OpeningDay();
            $dayEntity->setName($day);
            $manager->persist($dayEntity);
        }
        foreach ($days as $day) {
            $dayEntity = new OpeningDay();
            $dayEntity->setName($day);
            $manager->persist($dayEntity);
        }
        foreach ($days as $day) {
            $dayEntity = new OpeningDay();
            $dayEntity->setName($day);
            $manager->persist($dayEntity);
        }

        $manager->flush();
    }
}
