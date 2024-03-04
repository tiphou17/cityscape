<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectDetailsController extends AbstractController
{
    #[Route('/projectdetails', name: 'app_project_details')]
    public function index(): Response
    {
        return $this->render('project_details/index.html.twig', [
            'controller_name' => 'ProjectDetailsController',
            'breadcrumb_title' => 'Project Details',
        ]);
    }
}
