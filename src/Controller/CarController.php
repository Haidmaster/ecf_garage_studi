<?php

namespace App\Controller;


use App\Entity\Car;

use App\Entity\Image;
use App\Form\CarType;
use App\Service\PictureService;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/annonce', name: 'car_', methods: ['GET'])]
class CarController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(CarRepository $repo): Response
    {
        return $this->render(
            'car/index.html.twig',
            [
                'cars' => $repo->findAll()
            ]
        );
    }
    #[Route('/annonce/{id}', name: 'show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Car $car): Response
    {
        return $this->render(
            'car/details.html.twig',
            [

                'car' => $car
            ]
        );
    }

    #[Route('/creation', name: 'create', methods: ['GET', 'POST'])]
    public function add(Request $request, CarRepository $repo,  PictureService $pictureService): Response
    {

        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        // On recupère la requete du formulaire
        $form->handleRequest($request);

        // On vérifie si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère les images
            $images = $form->get('images')->getData();

            // On boucle $image qui est un tableau
            foreach ($images as $image) {
                // On définit le dossier de destination
                $folder = 'car';

                // On appelle le service d'ajout
                $fichier = $pictureService->add($image, $folder, 300, 300);

                $img = new Image();
                $img->setName($fichier);
                $car->addImage($img);
            }

            $car = $form->getData();
            $repo->save($car, true);
            $this->addFlash('succes', 'L\'annonce a bien été ajoutée.');
            return $this->redirectToRoute('car_index');
        }

        return $this->render('car/create.html.twig', [
            'car' => $car,
            'formCar' => $form->createView()
        ]);
    }

    #[Route('/edition/{id}', name: 'edit', requirements: ['id' => "\d+"], methods: ['GET', 'POST'])]
    public function edit(Car $car, Request $request, CarRepository $repo): Response
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repo->save($car, true);
            return $this->redirectToRoute('car_index');
        }

        return $this->render('car/edit.html.twig', [
            'formCar' => $form->createView()
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete', methods: ['GET'], requirements: ['id' => "\d+"],)]
    public function delete(Car $car, CarRepository $repo): Response
    {

        $repo->remove($car, true);
        return $this->redirectToRoute('car_index');
    }
}
