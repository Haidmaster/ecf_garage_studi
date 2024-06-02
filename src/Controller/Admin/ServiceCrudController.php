<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Entity\Service;
use App\Form\ServiceType;
use App\Service\PictureService;
use App\Repository\CarRepository;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/service', name: 'admin_service_', methods: ['GET'])]
class ServiceCrudController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ServiceRepository $prestRepo, CarRepository $carRepo): Response
    {
        return $this->render(
            'home/index.html.twig',
            [
                'services' => $prestRepo->findAll(),
                'cars' => $carRepo->findAll(),
            ]
        );
    }

    #[Route('/creation', name: 'create', methods: ['GET', 'POST'])]
    public function add(Request $request, ServiceRepository $repo, PictureService $pictureService): Response
    {

        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère les images
            $image = $form->get('image')->getData();


            // On définit le dossier de destination
            $folder = 'service';

            // On appelle le service d'ajout
            $fichier = $pictureService->add($image, $folder, 300, 300);

            $img = new Image();
            $img->setName($fichier);
            $service->setImage($img);
            $repo->save($service, true);
            $this->addFlash('succes', 'La service a bien été ajoutée.');
            return $this->redirectToRoute('app_home/#services');
        }

        return $this->render('admin/service/create.html.twig', [
            'service' => $service,
            'formservice' => $form->createView()
        ]);
    }

    #[Route('/edition/{id}', name: 'edit', requirements: ['id' => "\d+"], methods: ['GET', 'POST'])]
    public function edit(Service $service, Request $request, ServiceRepository $repo, PictureService $pictureService): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $image = $form->get('image')->getData();


            // On définit le dossier de destination
            $folder = 'service';

            // On appelle le service d'ajout
            $fichier = $pictureService->add($image, $folder, 300, 300);

            $img = new Image();
            $img->setName($fichier);
            $service->setImage($img);

            $repo->save($service, true);
            return $this->redirectToRoute('app_home');
        }

        return $this->render('admin/service/edit.html.twig', [
            'formservice' => $form->createView(),
            'service' => $service
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete', methods: ['POST'], requirements: ['id' => "\d+"],)]
    public function delete(Request $request, Service $service, ServiceRepository $repo): Response
    {

        if ($this->isCsrfTokenValid('delete' . $service->getId(), $request->request->get('_token'))) {
            $repo->remove($service, true);
        }

        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}
