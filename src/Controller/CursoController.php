<?php

namespace App\Controller;

use App\Entity\Encuentro;
use App\Entity\Resolucion;
use App\Entity\User;
use App\Repository\EncuentroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/cursos/', name: 'cursos_')]
class CursoController extends AbstractController
{
    #[Route('{id}', name: 'get')]
    public function index(Resolucion $resolucion): Response
    {
        return $this->render('curso/index.html.twig', [
            'resolucion' => $resolucion,
        ]);
    }

    #[Route('presente/{encuentro}/{alumno}', name: 'marcar_presente')]
    public function marcar_presente(Encuentro $encuentro, User $alumno, EncuentroRepository $repository,
                                    Request   $request): Response
    {
        $encuentro->addAsistente($alumno);
        $repository->save($encuentro, true);
        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('ausente/{encuentro}/{alumno}', name: 'quitar_presente')]
    public function quitar_presente(Encuentro $encuentro, User $alumno, EncuentroRepository $repository,
                                    Request   $request): Response
    {
        $encuentro->removeAsistente($alumno);
        $repository->save($encuentro, true);
        return $this->redirect($request->headers->get('referer'));
    }
}
