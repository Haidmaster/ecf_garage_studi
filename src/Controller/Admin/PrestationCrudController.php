<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Entity\Prestation;
use App\Form\PrestationType;
use App\Service\PictureService;
use App\Repository\PrestationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/prestation', name: 'admin_prestation_', methods: ['GET'])]
class PrestationCrudController extends AbstractController
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

    #[Route('/creation', name: 'create', methods: ['GET', 'POST'])]
    public function add(Request $request, PrestationRepository $repo, PictureService $pictureService): Response
    {

        $prestation = new Prestation();
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère les images
            $image = $form->get('image')->getData();


            // On définit le dossier de destination
            $folder = 'prestation';

            // On appelle le service d'ajout
            $fichier = $pictureService->add($image, $folder, 300, 300);

            $img = new Image();
            $img->setName($fichier);
            $prestation->setImage($img);
            $repo->save($prestation, true);
            $this->addFlash('succes', 'La prestation a bien été ajoutée.');
            return $this->redirectToRoute('prestation_index');
        }

        return $this->render('admin/prestation/create.html.twig', [
            'prestation' => $prestation,
            'formPrestation' => $form->createView()
        ]);
    }

    #[Route('/edition/{id}', name: 'edit', requirements: ['id' => "\d+"], methods: ['GET', 'POST'])]
    public function edit(Prestation $prestation, Request $request, PrestationRepository $repo, PictureService $pictureService): Response
    {
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère les images
            $image = $form->get('image')->getData();


            // On définit le dossier de destination
            $folder = 'prestation';

            // On appelle le service d'ajout
            $fichier = $pictureService->add($image, $folder, 300, 300);

            $img = new Image();
            $img->setName($fichier);
            $prestation->setImage($img);

            $repo->save($prestation, true);
            return $this->redirectToRoute('home');
        }

        return $this->render('admin/prestation/edit.html.twig', [
            'formPrestation' => $form->createView(),
            'prestation' => $prestation
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete', methods: ['POST'], requirements: ['id' => "\d+"],)]
    public function delete(Request $request, prestation $prestation, PrestationRepository $repo): Response
    {
        if ($this->isCsrfTokenValid('delete' . $prestation->getId(), $request->request->get('_token'))) {
            $repo->remove($prestation, true);
        }

        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        // $repo->remove($prestation, true);
        // return $this->redirectToRoute('home');
    }
}
