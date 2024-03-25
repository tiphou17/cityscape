<?php

namespace App\Controller;

use App\Entity\Contacttest;
use App\Form\ContactTestFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    public function __construct(private MailerInterface $mailer)
    {

    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $contact = new Contacttest;
        $form = $this->createForm(ContactTestFormType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new TemplatedEmail())
                ->from($form->get('email')->getData())
                ->to('admin@admin.admin')
                ->subject($form->get('subject')->getData())
                ->htmlTemplate('email/contact.html.twig')
                ->context([
                    'name' => $form->get('name')->getData(),
                    'number' => $form->get('number')->getData(),
                    'message' => $form->get('message')->getData(),
                    'mail' => $form->get('email')->getData()
                ]);

            $this->mailer->send($email);
            $this->addFlash('success', 'your email have been send');
            return $this->redirectToRoute('app_contact');

        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'ContactController',
            'breadcrumb_title' => 'Contact',
        ]);
    }








}

