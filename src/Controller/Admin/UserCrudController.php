<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/admin/utilisateur', name: 'admin_user_')]
class UserCrudController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/user/index.html.twig');
    }

    // Voir la liste des utilisateurs

    #[Route('/utilisateur', name: 'show')]
    public function show(UserRepository $userRepository): Response
    {

        $users = $userRepository->findAll();

        return $this->render('admin/user/index.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/creation', name: 'create')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $hasher,
        EntityManagerInterface $manager
    ): Response {

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $password = $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($password);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                'L\'utilisateur a bien été crée'
            );

            return $this->redirectToRoute('admin_user_show');
        }

        return $this->render('admin/user/add.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    // Supprimer un utilisateur

    #[Route('/utilisateur/{id}', name: 'delete')]
    public function delete(EntityManager $manager, User $user): Response
    {

        $manager->remove($user);
        $manager->flush();

        $this->addFlash(
            'success',
            'L\'utilisateur a bien été supprimé'
        );

        return $this->redirectToRoute('admin_user_show');
    }
}
