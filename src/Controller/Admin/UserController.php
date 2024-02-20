<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/admin/utilisateur', name: 'admin_user_')]
class UserController extends AbstractController
{

    /*
    /user                   : liste
    /user/{id}              : afficher un user
    /user/new               : créer un user
    /user/{id}/edit         : modifier un user
    /user/{id}/delete       : supprimer un user
*/

    #[Route('/', name: 'index')]
    public function index(UserRepository $repo): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $repo->findAll(),
        ]);
    }

    #[Route(path: '/creation', name: 'create')]
    public function new(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($passwordHasher->hashPassword($user, $user->getPassword()));
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Utilisateur créé avec succès');
            return $this->redirectToRoute('admin_user_index');
        }
        return $this->render('admin/user/create.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    #[Route('/edition/{id}/', name: 'edit')]
    public function edit(Request $request, EntityManagerInterface $em): Response
    {
        $user = $em->find(User::class, $request->get('id'));
        $form = $this->createForm(UserType::class, $user)->remove('password');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Utilisateur modifié avec succès');
        }
        return $this->render('admin/user/edit.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(int $id, EntityManagerInterface $em)
    {
        $user = $em->find(User::class, $id);
        $em->remove($user);
        $em->flush();
        $this->addFlash('success', 'Utilisateur supprimé avec succès');
        return $this->redirectToRoute('admin_user_index');
    }
}
