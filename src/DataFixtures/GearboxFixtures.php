<?php

namespace App\DataFixtures;

use App\Entity\Gearbox;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GearboxFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $gearboxList = ['Manuelle', 'Automatique', 'Semi-automatique'];


        foreach ($gearboxList as $gearbox_name) {
            $gearbox = new Gearbox();
            $gearbox->setName($gearbox_name);
            $manager->persist($gearbox);
        }

        $manager->flush();
    }
}
