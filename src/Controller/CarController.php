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
    public function index(
        CarRepository $carRepo
    ): Response {


        return $this->render(
            'car/index.html.twig',
            [
                'cars' =>  $carRepo->findAll(),
            ]
        );
    }



    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Car $car): Response
    {
        return $this->render(
            'car/details.html.twig',
            [

                'car' => $car, 'cars' => $car
            ]
        );
    }
}
