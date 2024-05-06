<?php

namespace App\Controller\Admin;

use App\Entity\OpeningHour;
use App\Form\OpeningHourType;
use App\Repository\OpeningDayRepository;
use App\Repository\OpeningHourRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/horaires', name: 'admin_hours_', methods: ['GET'])]
class OpeningHourController extends AbstractController
{

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(OpeningDayRepository $repo): Response
    {
        return $this->render(
            'admin/openingHours/index.html.twig',
            [
                'openingHours' => $repo->findAll()
            ]
        );
    }

    #[Route('/creation', name: 'create', methods: ['GET', 'POST'])]
    public function add(Request $request, OpeningHourRepository $repo): Response
    {


        $openingHour = new OpeningHour();
        $form = $this->createForm(OpeningHourType::class, $openingHour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repo->save($openingHour, true);
            $this->addFlash('succes', 'L\'horaire a bien été modifié.');
            return $this->redirectToRoute('admin_hours_index');
        }

        return $this->render('admin/openingHours/create.html.twig', [
            'openingHour' => $openingHour,
            'formOpeningHour' => $form->createView()
        ]);
    }

    #[Route('/edition/{id}', name: 'edit', requirements: ['id' => "\d+"], methods: ['GET', 'POST'])]
    public function edit(OpeningHour $openingHour, Request $request, OpeningHourRepository $repo): Response
    {
        $form = $this->createForm(OpeningHourType::class, $openingHour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repo->save($openingHour, true);
            return $this->redirectToRoute('admin_hours_index');
        }

        return $this->render('admin/openingHour/edit.html.twig', [
            'formOpeningHour' => $form->createView()
        ]);
    }
}
