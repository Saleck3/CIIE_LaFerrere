<?php

namespace App\DataFixtures;

use App\Entity\Cohorte;
use App\Entity\Curso;
use App\Entity\Encuentro;
use App\Entity\Resolucion;
use App\Entity\User;
use DateInterval;
use DateTime;
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
        $adminUser->setDni("1111111");
        $adminUser->setPassword($this->passwordHasher->hashPassword($adminUser, "WGb8dt669Y4PHF"));
        $adminUser->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($adminUser);

        $profeUser = new User();
        $profeUser->setUsername('Profesor');
        $profeUser->setEmail('profe@coso.com');
        $profeUser->setDni("222222222");
        $profeUser->setPassword($this->passwordHasher->hashPassword($profeUser, "asdagrgqe546"));
        $profeUser->setRoles(['ROLE_TEACHER']);
        $manager->persist($profeUser);

        $alumnoUser = new User();
        $alumnoUser->setUsername('Alumno default');
        $alumnoUser->setEmail('alumno@coso.com');
        $alumnoUser->setDni("333333333");
        $alumnoUser->setPassword($this->passwordHasher->hashPassword($alumnoUser, "asdagrgqe546"));
        $manager->persist($alumnoUser);

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

        $resolucion = new Resolucion();
        $resolucion->setClave("Resolucion default");
        $resolucion->setCurso($curso);
        $resolucion->setCohorte($cohorte);
        $resolucion->setDocente($profeUser);
        $resolucion->addCursante($alumnoUser);

        //Agrego varios alumnos de prueba
        for ($i = 1; $i < 15; $i++) {
            $alumno = new User();
            $alumno->setUsername('alumno' . $i);
            $alumno->setEmail("alumno$i@coso.com");
            $alumno->setDni(1111111 * $i);
            $alumno->setPassword($this->passwordHasher->hashPassword($alumnoUser, "alumno$i"));
            $manager->persist($alumno);
            $resolucion->addCursante($alumno);
        }
        $manager->persist($resolucion);


        $fecha = new DateTime('2024-01-01');
        for ($i = 0; $i < 5; $i++) {
            $encuentro = new Encuentro();
            $encuentro->setResolucion($resolucion);
            $encuentro->setDate($fecha->add(new DateInterval('P' . $i . 'D')));
            $manager->persist($encuentro);
        }
        //Almenos un presente
        $encuentro->addAsistente($alumnoUser);
        $manager->persist($encuentro);

        $manager->flush();
    }
}
