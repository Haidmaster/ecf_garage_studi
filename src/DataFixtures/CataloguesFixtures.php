<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Model;
use App\Entity\Energy;
use App\Entity\Gearbox;
use App\Entity\service;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CataloguesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        /*********  serviceS FIXTURES  *********/

        $services =
            [
                'Entretien avec remise à zéro' => ['Le Garage effectue vos révisions périodiques et vidanges avec remise à zéro des témoins d’entretien, sur tous types de véhicules, même les plus récents.'],
                'Mécanique générale' => ['Nous intervenons sur tous types de travaux, sur de l’entretien classique aussi bien que sur de la mécanique lourde, comme remplacement ou réfection d’un moteur.'],
                'Diagnostic et recherche de pannes' => ['Le garage est équipé de matériel diagnostic haut de gamme mis à jour afin de pouvoir interroger vos calculateurs et faire le meilleur diagnostic possible.'],
            ];

        foreach ($services as $service_name =>  $content) {
            $service = new service();
            $service->setName($service_name);
            foreach ($content as $service_content) {
                $service->setContent($service_content);
            }
            $manager->persist($service);
        }
        /*********  MODELS FIXTURES  *********/

        $modelList = [

            'Audi'    => ['a1', 'a3', 'a4', 'q5'],
            'BMW'       => ['Serie-1', 'Serie-2', 'Serie-3', 'Serie-4'],
            'Kia'   => ['Niro', 'Sportage', 'EV6', 'Proceed', 'Ceed'],
            'Toyota'    => ['Prius', 'Corolla', 'Camry', 'Rav-4'],
            'Mercedes'       => ['Classe-A', 'Classe-E', 'Classe-C', 'Classe-S'],
            'Renault'       => ['Clio', 'Megane', 'Austral', 'Arkana'],

        ];

        foreach ($modelList as $brand_name => $models) {
            $brand = new Brand();
            $brand->setName($brand_name);
            foreach ($models as $model_name) {
                $model = new Model();
                $model->setName($model_name);
                $manager->persist($model);
                $brand->addModel($model);
            }
            $manager->persist($brand);
        }



        /*********  ENERGY FIXTURES *********/

        $energys = ['Diesel', 'Essence', 'Hybride', 'Electrique'];

        foreach ($energys as $energy) {
            $energyEntity = new Energy();
            $energyEntity->setName($energy);
            $manager->persist($energyEntity);
        }



        /*********  GEARBOX FIXTURES  *********/

        $gearboxList = ['Manuelle', 'Automatique', 'Semi-automatique'];


        foreach ($gearboxList as $gearbox_name) {
            $gearbox = new Gearbox();
            $gearbox->setName($gearbox_name);
            $manager->persist($gearbox);
        }

        // $manager->flush();
    }
}
