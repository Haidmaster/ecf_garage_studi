<?php

namespace App\Controller;

use App\Repository\BrandRepository;
use App\Repository\CarRepository;
use App\Repository\EnergyRepository;
use App\Repository\GearboxRepository;
use App\Repository\ModelRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CarFiltersController extends AbstractController
{
    #[Route('/api/annonces', name: 'car_all', methods: ['GET'])]
    public function getAllCar(
        CarRepository $carRepo,
        GearboxRepository $gearboxRepo,
        EnergyRepository $energyRepo,
        Request $request
    ): Response {

        $cars = $carRepo->findAll();
        $gearboxes = $gearboxRepo->findAll();
        $energys = $energyRepo->findAll();

        // Check if ajax request
        if ($request->get('ajax')) {
            return new JsonResponse([
                "content" => $this->renderView(
                    'car/_carCard.html.twig',
                    compact('cars')
                )
            ]);
        }
        return $this->render("car/_carCard.html.twig", compact('cars',  'gearboxes', 'energys'));
    }

    #[Route('/api/annonces/boite/{id}', name: 'car_gearbox', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getCarByGearbox(
        int $id,
        CarRepository $carRepo,
        GearboxRepository $gearboxRepo,
        EnergyRepository $energyRepo,
        Request $request,
    ): Response {

        // filtre par boite de vitesse
        $cars = $carRepo->findByGearbox($id);
        $gearboxes = $gearboxRepo->findAll();
        $energys = $energyRepo->findAll();

        // Check if ajax request
        if ($request->get('ajax')) {
            return new JsonResponse([
                "content" => $this->renderView(
                    'car/_carCard.html.twig',
                    compact('cars')
                )
            ]);
        }
        return $this->render("car/_carCard.html.twig", compact('cars', 'gearboxes', 'energys'));
    }

    #[Route('/api/annonces/energie/{id}', name: 'car_energy', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getCarByEnergy(
        int $id,
        CarRepository $carRepo,
        GearboxRepository $gearboxRepo,
        EnergyRepository $energyRepo,
        Request $request
    ): Response {

        // filtre par energie
        $cars = $carRepo->findByEnergy($id);
        $gearboxes = $gearboxRepo->findAll();
        $energys = $energyRepo->findAll();

        // Check if ajax request
        if ($request->get('ajax')) {
            return new JsonResponse([
                "content" => $this->renderView(
                    'car/_carCard.html.twig',
                    compact('cars')
                )
            ]);
        }
        return $this->render("car/_carCard.html.twig", compact('cars', 'gearboxes', 'energys'));
    }

    #[Route('/api/annonces/marque/{id}', name: 'car_brand', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function findByBrand(
        int $id,
        ModelRepository $modelRepo,
        GearboxRepository $gearboxRepo,
        EnergyRepository $energyRepo,
        BrandRepository $brandRepo,
        Request $request
    ): Response {

        // filtre par marque     
        $models = $modelRepo->findByBrand($id);
        $gearboxes = $gearboxRepo->findAll();
        $energys = $energyRepo->findAll();
        $brands = $brandRepo->findAll();

        // Check if ajax request
        if ($request->get('ajax')) {
            return new JsonResponse([
                "content" => $this->renderView(
                    'car/_carCard.html.twig',
                    compact('models')
                )
            ]);
        }
        return $this->render("car/_carCard.html.twig", compact('models', 'gearboxes', 'energys', 'brands'));
    }
}
