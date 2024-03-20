<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyDetailsController extends AbstractController
{
    #[Route('/property/{id}', name: 'app_property_details')]
    public function index(Property $property): Response
    {
        dump($property);
        return $this->render('property_details/index.html.twig', [
            'property' => $property,
            'controller_name' => 'PropertyDetailsController',
            'breadcrumb_title' => 'Property Details',
        ]);
    }
}
