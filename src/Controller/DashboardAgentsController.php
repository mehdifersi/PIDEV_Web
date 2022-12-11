<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardAgentsController extends AbstractController
{
    #[Route('/dashboard/agents', name: 'app_dashboard_agents')]
    public function index(): Response
    {
        return $this->render('dashboard_agents/index.html.twig', [
            'controller_name' => 'DashboardAgentsController',
        ]);
    }
}
