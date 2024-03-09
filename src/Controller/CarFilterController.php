<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarFilterController extends AbstractController
{
    #[Route('/car/energy', name: 'car_energy')]
    public function byEnergy(CarRepository $carRepo): JsonResponse
    {

        return $this->Json([$carRepo->findByEnergys()]);
    }
    // #[Route('/car/energy', name: 'car_energy')]
    // public function index(CarRepository $carRepo): Response
    // {


    //     $carByEnergy = $carRepo->findByEnergy();
    //     dd($carByEnergy);

    //     $response = new JsonResponse();
    //     $response->setData($carByEnergy);

    //     return new JsonResponse($arrayCollection);
    // }
}
