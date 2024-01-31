<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Model;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CatalogueFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $modelList = [

            'Audi'    => ['a1', 'a3', 'a4', 'q5'],
            'BMW'       => ['Serie-1', 'Serie-2', 'Serie-3', 'Serie-4'],
            'Kia'   => ['Niro', 'Sportage', 'EV6', 'Proceed', 'Ceed'],
            'Toyota'    => ['Prius-4', 'Corolla', 'Camry', 'Rav-4'],
            'Mercedes'       => ['Classe-A', 'Classe-E', 'Classe-C', 'Classe-S'],
            'Renault'       => ['Clio', 'Megane', 'Austral', 'Arkana'],

        ];
        foreach ($modelList as $brand_name => $models) {
            $brand = new Brand();
            $brand->setName($brand_name);
            foreach ($models as $brand_model) {
                $model = new Model();
                $model->setName($brand_model);
                $manager->persist($model);
                $brand->addModel($model);
            }
            $manager->persist($brand);
        }
        $manager->flush();
    }
}
