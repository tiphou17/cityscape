<?php

namespace App\Controller\Cart;


use Stripe\Stripe;
use App\Entity\Cart;
use Doctrine\ORM\EntityManager;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/cart/add/location/{id}', name: 'app_add_cart')]
    #[IsGranted('ROLE_USER')]
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
    #[IsGranted('ROLE_USER')]
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
    #[IsGranted('ROLE_USER')]
    public function delete(SessionInterface $session, $id)
    {
        $panier = $session->get('panier', []);

        if (!empty ($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_show_cart');
    }

    #[Route('/cart/total/stripePayment', name: 'app_stripe_payment')]
    #[IsGranted('ROLE_USER')]
    public function payment(SessionInterface $session, PropertyRepository $propertyRepository): Response
    {
        $stripeSK = $_ENV['STRIPE_SECRET_KEY'];
        Stripe::setApiKey($stripeSK);

        $panier = $session->get('panier', []);

        $lineItems = [];
        foreach ($panier as $id => $quantity) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $propertyRepository->find($id)->getTitle()
                    ],
                    'unit_amount' => $propertyRepository->find($id)->getPropPrice() * 100   //stripe fonctionne en centimes
                ],
                'quantity' => $quantity,
            ];

        }

        $session_payment = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card', 'bancontact'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => 'http://127.0.0.1:8000/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $this->generateUrl('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL)

        ]);

        return $this->redirect($session_payment->url, 303);
    }

    #[Route('/success', name: 'app_success')]
    #[IsGranted('ROLE_USER')]
    public function success(SessionInterface $session, PropertyRepository $propertyRepository, EntityManagerInterface $manager): Response
    {
        $panier = $session->get('panier', []);

        // je fais une boucle pour insérer la commande en base de donnée
        foreach ($panier as $id => $quantity) {
            $item = new Cart();
            $item->setUser($this->getUser());
            $item->setStripeId('123456');
            $item->addProperty($propertyRepository->find($id));
            $manager->persist($item);
            $manager->flush();

        }
        $manager->flush();
        $session->set('panier', []);


        return $this->render('cart/success.html.twig');
    }

    #[Route('/cancel', name: 'cancel_url')]
    #[IsGranted('ROLE_USER')]
    public function cancel(SessionInterface $session): Response
    {
        $session->get('panier', []);

        return $this->render('cart/cancel.html.twig');
    }
}
;
