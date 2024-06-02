<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ServiceRepository $repo, Service $service): Response
    {
        return $this->render(
            'home/index.html.twig',
            ['services' => $repo->findAll(), 'service' => $service]
        );
    }
}
