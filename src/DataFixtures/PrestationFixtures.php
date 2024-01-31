<?php

namespace App\DataFixtures;

use App\Entity\Prestation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PrestationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $prestationList =
            [
                'Entretien avec remise à zéro' => ['Le Garage effectue vos révisions périodiques et vidanges avec remise à zéro des témoins d’entretien, sur tous types de véhicules, même les plus récents.'],
                'Mécanique générale' => ['Nous intervenons sur tous types de travaux, sur de l’entretien classique aussi bien que sur de la mécanique lourde, comme remplacement ou réfection d’un moteur.'],
                'Diagnostic et recherche de pannes' => ['Le garage est équipé de matériel diagnostic haut de gamme mis à jour afin de pouvoir interroger vos calculateurs et faire le meilleur diagnostic possible.'],
            ];

        foreach ($prestationList as $prestation_name =>  $content) {
            $prestation = new Prestation();
            $prestation->setName($prestation_name);
            foreach ($content as $prestation_content) {
                $prestation->setContent($prestation_content);


                $manager->persist($prestation);
            }
            $manager->flush();
        }
    }
}
