<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Form\PrestationType;
use App\Repository\PrestationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/prestation', name: 'prestation_', methods: ['GET'])]
class PrestationController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(PrestationRepository $repo): Response
    {
        return $this->render(
            'prestation/index.html.twig',
            [
                'prestations' => $repo->findAll(),
            ]
        );
    }

    // #[Route('/prestation/creation', name: 'create', methods: ['GET', 'POST'])]
    // public function add(Request $request, PrestationRepository $repo): Response
    // {

    //     $prestation = new Prestation();
    //     $form = $this->createForm(PrestationType::class, $prestation);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $repo->save($prestation, true);
    //         $this->addFlash('succes', 'L\'annonce a bien été ajoutée.');
    //         return $this->redirectToRoute('prestation_index');
    //     }

    //     return $this->render('prestation/create.html.twig', [
    //         'prestation' => $prestation,
    //         'formPrestation' => $form->createView()
    //     ]);
    // }

    #[Route('/edition/{id}', name: 'edit', requirements: ['id' => "\d+"], methods: ['GET', 'POST'])]
    public function edit(Prestation $prestation, Request $request, PrestationRepository $repo): Response
    {
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repo->save($prestation, true);
            return $this->redirectToRoute('home');
        }

        return $this->render('prestation/edit.html.twig', [
            'formPrestation' => $form->createView()
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete', methods: ['GET'], requirements: ['id' => "\d+"],)]
    public function delete(prestation $prestation, PrestationRepository $repo): Response
    {

        $repo->remove($prestation, true);
        return $this->redirectToRoute('home');
    }
}
