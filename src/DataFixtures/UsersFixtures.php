<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $userPasswordHasherInterface)
    {
    }

    public function load(ObjectManager $manager): void
    {


        /*********  USERS FIXTURES  *********/

        $user = new User();
        $user->setEmail('admin@site.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->userPasswordHasherInterface->hashPassword($user, 'password'));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('employe1@site.com');
        $user->setRoles(['ROLE_ADMIN_EMPLOYEE']);
        $user->setPassword($this->userPasswordHasherInterface->hashPassword($user, 'password'));
        $manager->persist($user);



        $manager->flush();
    }
}
