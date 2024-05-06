<?php

namespace App\Controller\Admin;


use App\Entity\Model;
use App\Form\ModelType;
use App\Repository\ModelRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/modele', name: 'admin_model_', methods: ['GET'])]
class ModelCrudController extends AbstractController
{

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ModelRepository $repo): Response
    {
        return $this->render(
            'admin/car/model/index.html.twig',
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
            return $this->redirectToRoute('admin_model_index');
        }

        return $this->render('admin/car/model/create.html.twig', [
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
            return $this->redirectToRoute('admin_model_index');
        }

        return $this->render('admin/car/model/edit.html.twig', [
            'formModel' => $form->createView()
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete', methods: ['POST'], requirements: ['id' => "\d+"],)]
    public function delete(Model $model, ModelRepository $repo, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $model->getId(), $request->request->get('_token'))) {
            $repo->remove($model, true);
        }

        return $this->redirectToRoute('admin_model_index', [], Response::HTTP_SEE_OTHER);
        // $repo->remove($model, true);
        // return $this->redirectToRoute('admin_model_index');
    }
}
