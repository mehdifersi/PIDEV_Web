<?php

namespace App\Controller;

use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgentLoginController extends AbstractController
{
    #[Route('/login/agent', name: 'app_agent_login')]
    public function index(): Response
    {

        return $this->render('security/loginagent.html.twig', [
            'controller_name' => 'AgentLoginController',
        ]);
    }
}
