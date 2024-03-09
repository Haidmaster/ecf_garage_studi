<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/admin/utilisateur', name: 'admin_user_')]
class ChangePasswordController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/user/index.html.twig');
    }

    // modifier mot de passe utilisateur

    #[Route('/edition-mot-de-passe/utilisateur/{id}', name: 'edit.password')]
    public function editPassword(
        User $user,
        Request $request,
        UserPasswordHasherInterface $hasher,
        EntityManagerInterface $manager
    ): Response {

        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $new_password = $form->get('password')->getData();

            $password = $hasher->hashPassword($user, $new_password);

            $user->setPassword($password);

            $manager->flush();

            $this->addFlash(
                'success',
                'Le mot de passe a bien été modifié.'
            );

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/editpassword.html.twig', [
            'passwordForm' => $form->createView()
        ]);
    }
}
