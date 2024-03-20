<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{
    #[Route('/properties/{menu}/{subId}-{subMenu}', name: 'app_property')]
    public function index(PropertyRepository $property, $subMenu, $subId, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
        $properties = $property->filterPropertyByCategory($subMenu, $subId);
        // dd('toto');
        $pagination = $paginator->paginate(
            $properties, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            12
        );

        return $this->render('property/index.html.twig', [
            'properties' => $pagination,
            'breadcrumb_title' => 'Property',
        ]);
    }
}
