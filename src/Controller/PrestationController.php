<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Repository\PrestationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PrestationController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(PrestationRepository $repo, Prestation $prestation): Response
    {
        return $this->render(
            'prestation/index.html.twig',
            [
                'prestations' => $repo->findAll(),
                'prestation' => $prestation
            ]
        );
    }
}
