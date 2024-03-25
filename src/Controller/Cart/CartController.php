<?php

namespace App\Controller\Cart;


use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/cart/add/location/{id}', name: 'app_add_cart')]
    public function add(SessionInterface $session, $id)
    {
        $panier = $session->get('panier', []);

        if (!empty ($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        $session->set('panier', $panier);

        return $this->redirectToRoute('app_show_cart');
    }

    #[Route('/cart/total/show', name: 'app_show_cart')]
    public function show(SessionInterface $session, PropertyRepository $propertyRepository): Response
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];
        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'product' => $propertyRepository->find($id),
                'quantity' => $quantity

            ];
        }

        $total = 0;

        foreach ($panierWithData as $item) {
            $totalItem = $item['product']->getPropPrice() * $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('cart/index.html.twig', [
            'items' => $panierWithData,
            'total' => $total,
            'breadcrumb_title' => 'Cart'
        ]);
    }

    #[Route('/cart/delete/location/{id}', name: 'app_delete_cart')]
    public function delete(SessionInterface $session, $id)
    {
        $panier = $session->get('panier', []);

        if (!empty ($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_show_cart');
    }

    // #[Route('/cart/total/stripePayment', name: 'app_stripe_payment')]
}
;
