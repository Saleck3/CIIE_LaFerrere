<?php

namespace App\DataFixtures;

use App\Entity\Cohorte;
use App\Entity\Curso;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $adminUser = new User();
        $adminUser->setUsername('Saleck');
        $adminUser->setEmail('admin@example.com');
        $adminUser->setPassword($this->passwordHasher->hashPassword($adminUser, "WGb8dt669Y4PHF"));
        $adminUser->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($adminUser);

        $cohorte = new Cohorte();
        $cohorte->setName("1ch24");
        $cohorte->setStartDate(new \DateTime('2024-02-01'));
        $cohorte->setEndDate(new \DateTime('2024-04-01'));
        $manager->persist($cohorte);

        $cohorte2 = new Cohorte();
        $cohorte2->setName("2ch24");
        $cohorte2->setStartDate(new \DateTime('2024-05-01'));
        $cohorte2->setEndDate(new \DateTime('2024-07-01'));
        $manager->persist($cohorte2);

        $curso = new Curso();
        $curso->setName("Adultos");
        $curso->setClave("Adult");
        $manager->persist($curso);

        $curso2 = new Curso();
        $curso2->setName("Ambiente Natural y Social");
        $curso2->setClave("ANyS-Ini");
        $manager->persist($curso2);

        $manager->flush();
    }
}
