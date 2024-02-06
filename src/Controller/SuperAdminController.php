<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/super_admin', name: 'app_super_admin_')]
class SuperAdminController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('super_admin/index.html.twig', [
            'controller_name' => 'SuperAdminController',
        ]);
    }
}
