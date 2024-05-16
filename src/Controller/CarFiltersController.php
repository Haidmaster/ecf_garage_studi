<?php

namespace App\Controller;

use App\Repository\CarRepository;
use App\Repository\EnergyRepository;
use App\Repository\GearboxRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CarFiltersController extends AbstractController
{
    #[Route('/annonces', name: 'cars_all', methods: ['GET'])]
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
                    compact('cars', 'gearboxes', 'energys', 'content')
                )
            ]);
        }
    }

    #[Route('/annonces/boite/{id}', name: 'car_gearbox', requirements: ['id' => '\d+'], methods: ['GET'])]
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
                    compact('cars', 'gearboxes', 'energys', 'js-car-content')
                )
            ]);
        }
    }

    #[Route('/annonces/energie/{id}', name: 'car_energy', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function getCarByEnergy(
        int $id,
        CarRepository $carRepo,
        GearboxRepository $gearboxRepo,
        EnergyRepository $energyRepo,
        Request $request
    ): Response {

        // filtre par boite de vitesse
        $cars = $carRepo->findByEnergy($id);
        $gearboxes = $gearboxRepo->findAll();
        $energys = $energyRepo->findAll();

        // Check if ajax request
        if ($request->get('ajax')) {
            return new JsonResponse([
                "content" => $this->renderView(
                    'car/_carCard.html.twig',
                    compact('cars', 'gearboxes', 'energys', 'js-car-content')
                )
            ]);
        }
    }
}
