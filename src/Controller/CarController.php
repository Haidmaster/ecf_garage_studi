<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;
use App\Repository\EnergyRepository;
use App\Repository\GearboxRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/annonces', name: 'car_', methods: ['GET'])]
class CarController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(
        CarRepository $carRepo,
        GearboxRepository $gearboxRepo,
        EnergyRepository $energyRepo,
    ): Response {

        $cars = $carRepo->findAll();
        $gearboxes = $gearboxRepo->findAll();
        $energys = $energyRepo->findAll();

        return $this->render(
            'car/index.html.twig',
            compact('cars', 'gearboxes', 'energys')
        );
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Car $car): Response
    {
        return $this->render(
            'car/details.html.twig',
            ['car' => $car, 'cars' => $car]
        );
    }
}
