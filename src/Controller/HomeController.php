<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ResolucionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{

    #[Route('/')]
    #[Route('/home', name: "app_home")]
    public function index(ResolucionRepository $resoluciones): Response
    {


        /** @var User $currentUser */
        $currentUser = $this->getUser();
        if (!empty($currentUser)) {
            $resoluciones_to_show = $resoluciones->findAllByUser($currentUser);
        }

        return $this->render("home/index.html.twig", [
            'resoluciones' => $resoluciones_to_show ?? null
        ]);
    }
}
