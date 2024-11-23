<?php

namespace App\Controller;

use App\Entity\Resolucion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CursoController extends AbstractController
{
    #[Route('/curso/{id}', name: 'app_curso')]
    public function index(Resolucion $resolucion): Response
    {

        return $this->render('curso/index.html.twig', [
            'resolucion' => $resolucion,
        ]);
    }
}
