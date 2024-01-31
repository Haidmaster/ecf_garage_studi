<?php

namespace App\Controller;


use App\Entity\Car;

use App\Form\CarType;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


// #[Route('/annonces', name: 'car_', methods: ['GET'])]
class CarController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(CarRepository $repo): Response
    {
        return $this->render(
            'car/_carCard.html.twig',
            [
                'cars' => $repo->findAll()
            ]
        );
    }
    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'], methods: ['GET'])]
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
    public function add(Request $request, CarRepository $repo): Response
    {

        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
