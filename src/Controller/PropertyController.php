<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{
    #[Route('/property', name: 'app_property')]
    public function index(PropertyRepository $property): Response
    {

        return $this->render('property/index.html.twig', [
            'controller_name' => 'PropertyController',
            'properties' => $property->findAll(),
            'breadcrumb_title' => 'Property',
        ]);
    }
}
