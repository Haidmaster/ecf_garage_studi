<?php

namespace App\Controller;


use App\Entity\Car;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/annonce', name: 'car_', methods: ['GET'])]
class CarController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(CarRepository $repo, Car $car): Response
    {

        return $this->render(
            'car/_carCard.html.twig',
            [
                'cars' => $repo->findAll(),
                'car' => $car
            ]
        );
    }
    #[Route('/{id}', name: 'show',  methods: ['GET'])]
    public function show(Car $car): Response

    {
        return $this->render(
            'car/details.html.twig',
            [
                'car' => $car,

            ]
        );
    }
}
