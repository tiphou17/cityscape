<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class dashboardController extends AbstractController
{
    #[Route('/back/dashboard', name: 'app_back_dashboard')]
    public function index(): Response
    {
        return $this->render('back/dashboard/index.html.twig', [
            'controller_name' => 'dashboardController',
        ]);
    }
}
