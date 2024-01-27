<?php

namespace App\Controller;


use App\Entity\Model;
use App\Form\ModelType;
use App\Repository\ModelRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[Route('/modele', name: 'model_', methods: ['GET'])]
class ModelController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ModelRepository $repo): Response
    {
        return $this->render(
            'model/index.html.twig',
            [
                'models' => $repo->findAll()
            ]
        );
    }

    #[Route('/creation', name: 'create', methods: ['GET', 'POST'])]
    public function add(Request $request, ModelRepository $repo): Response
    {

        $model = new Model();

        $form = $this->createForm(ModelType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repo->save($model, true);
            $this->addFlash('succes', 'La modele a bien été ajoutée.');
            return $this->redirectToRoute('model_index');
        }

        return $this->render('model/create.html.twig', [
            'model' => $model,
            'formModel' => $form->createView()
        ]);
    }

    #[Route('/edition/{id}', name: 'edit', requirements: ['id' => "\d+"], methods: ['GET', 'POST'])]
    public function edit(Model $model, Request $request, ModelRepository $repo): Response
    {
        $form = $this->createForm(ModelType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repo->save($model, true);
            return $this->redirectToRoute('model_index');
        }

        return $this->render('model/edit.html.twig', [
            'formModel' => $form->createView()
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete', methods: ['GET'], requirements: ['id' => "\d+"],)]
    public function delete(Model $model, ModelRepository $repo): Response
    {

        $repo->remove($model, true);
        return $this->redirectToRoute('model_index');
    }
}
