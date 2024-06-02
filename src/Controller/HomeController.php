<?php

namespace App\Controller;

use App\Repository\CarRepository;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        CarRepository $carRepo,
        ServiceRepository $serviceRepo,
        ParameterBagInterface $parameterBagInterface
    ): Response {


        $limit = $parameterBagInterface->get('home_cars_limit');

        $cars = $carRepo->findBy([], ['id' => 'DESC'], $limit);

        return $this->render('home/index.html.twig', [
            'cars' => $cars,
            'services' => $serviceRepo->findAll()
        ]);
    }
}
