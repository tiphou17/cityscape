<?php

namespace App\Controller\Authentification;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FacebookController extends AbstractController
{
    #[Route('/logintest', name: 'app_logintest')]
    public function index(): Response
    {
        return $this->render('facebook/index.html.twig');
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }

    #[Route('/connect/facebook', name: 'connect_facebook')]
    public function connectAction(ClientRegistry $clientRegistry): RedirectResponse
    {
        //Redirect to facebook
        return $clientRegistry->getClient('facebook')->redirect(['public_profile', 'email'], []);
    }

    /**
     * After going to facebook, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config/packages/knpu_oauth2_client.yaml
     */
    #[Route('/connect/facebook/check', name: 'connect_facebook_check')]
    public function connectCheckAction(Request $request)
    {
        // ** if you want to *authenticate* the user, then
        // leave this method blank and create a Guard authenticator
    }
}