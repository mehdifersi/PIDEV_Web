<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'app_admin_dashboard')]
    public function index(): Response
    {
        return $this->render('admin_dashboard/index.html.twig', [
            'controller_name' => 'AdminDashboardController',
        ]);
    }
    #[Route('/admin/login', name: 'app_admin_login')]
    public function indexjjj(): Response
    {
        return $this->render('security/loginadmin.html.twig', [
            'controller_name' => 'AdminDashboardController',
        ]);
    }
}
