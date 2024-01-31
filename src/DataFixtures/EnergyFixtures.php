<?php

namespace App\DataFixtures;

use App\Entity\Energy;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EnergyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $energyList = ['Diesel', 'Essence', 'Hybride', 'Electrique'];


        foreach ($energyList as $energy_name) {
            $energy = new Energy();
            $energy->setName($energy_name);
            $manager->persist($energy);
        }


        $manager->flush();
    }
}
