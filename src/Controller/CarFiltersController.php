<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;
use App\Repository\EnergyRepository;
use App\Repository\GearboxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarFiltersController extends AbstractController
{
    #[Route('/boite-de-vitesse/id', name: 'gearbox_id', methods: ['GET'])]
    public function byGearbox(
        CarRepository $carRepo,
        GearboxRepository $gearboxRepo,

        Request $request
    ): Response {

        $cars = $carRepo->findAll();
        // filtre par boite de vitesse        

        $carByGearbox =  $carRepo->findByGearbox();

        $gearboxes = $gearboxRepo->findAll();

        // if($request('ajax') {
        //     $gearboxId = $request->get('gearboxId');
        //     $carByGearbox =  $carRepo->findByGearbox()


        // });


        return $this->render(
            'car/index.html.twig',
            compact('cars', 'carByGearbox', 'gearboxes')
        );

        // return new JsonResponse($carByGearbox);
    }

    #[Route('/energie', name: 'byEnergy', methods: ['GET'])]
    public function byEnergy(
        CarRepository $carRepo,
        Request $request
    ): Response {

        // filtre par boite de vitesse
        $energyId =  $request->get('energyId');
        $carsByEnergy = $carRepo->findByEnergy($energyId);

        return new JsonResponse($carsByEnergy);
    }
}
