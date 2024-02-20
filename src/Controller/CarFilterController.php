<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarFilterController extends AbstractController
{
    #[Route('/car/filter', name: 'app_car_filter')]
    public function index(CarRepository $carRepo): Response
    {


        $carByEnergy = $carRepo->findByEnergy();
        dd($carByEnergy);

        $response = new JsonResponse();
        $response->setData($carByEnergy);

        return new JsonResponse($arrayCollection);
    }
}
