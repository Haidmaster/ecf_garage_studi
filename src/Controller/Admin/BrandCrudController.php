<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use App\Form\BrandType;
use App\Repository\BrandRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/marques', name: 'admin_brand_', methods: ['GET'])]
class BrandCrudController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(BrandRepository $repo): Response
    {
        return $this->render(
            'admin/car/brand/index.html.twig',
            [
                'brands' => $repo->findAll()
            ]
        );
    }

    #[Route('/creation', name: 'create', methods: ['GET', 'POST'])]
    public function add(Request $request, BrandRepository $repo): Response
    {

        $brand = new Brand();

        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repo->save($brand, true);
            $this->addFlash('succes', 'La marque a bien été ajoutée.');
            return $this->redirectToRoute('brand_index');
        }

        return $this->render('admin/car/brand/create.html.twig', [
            'brand' => $brand,
            'formBrand' => $form->createView()
        ]);
    }

    #[Route('/edition/{id}', name: 'edit', requirements: ['id' => "\d+"], methods: ['GET', 'POST'])]
    public function edit(Brand $brand, Request $request, BrandRepository $repo): Response
    {
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repo->save($brand, true);
            return $this->redirectToRoute('brand_index');
        }

        return $this->render('admin/car/brand/edit.html.twig', [
            'formBrand' => $form->createView()
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete', methods: ['GET'], requirements: ['id' => "\d+"],)]
    public function delete(Brand $brand, BrandRepository $repo): Response
    {

        $repo->remove($brand, true);
        return $this->redirectToRoute('admin_brand_index');
    }
}
