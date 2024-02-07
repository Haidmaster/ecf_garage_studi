<?php

namespace App\Controller;

use App\Repository\CarRepository;
use PhpParser\JsonDecoder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarFiltersController extends AbstractController
{
    #[Route('/filters', name: 'filters', methods: ['GET'])]
    public function index(CarRepository $repo): JsonResponse
    {

        $gearboxes = $repo->findByGearboxes();
        // $minPrice = $repo->findByMinPrice($min);

        return $this->json($gearboxes);
    }
}
