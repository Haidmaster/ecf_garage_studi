<?php

namespace App\Controller;

use App\Repository\CarRepository;
use App\Repository\PrestationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CarRepository $car, PrestationRepository $prestation): Response
    {
        return $this->render('home/index.html.twig', [
            'cars' => $car->findAll(),
            'prestations' => $prestation->findAll(),
            'prestation' => $prestation
        ]);
    }
}
