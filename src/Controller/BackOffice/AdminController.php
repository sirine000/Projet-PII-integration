<?php

namespace App\Controller\BackOffice;  // Utiliser BackOffice avec un backslash

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminController extends AbstractController
{
    #[Route('/dashboard', name: 'app_back_office_admin')]
    public function index(): Response
    {
        return $this->render('back_office/dashboard.html.twig', [
            'controller_name' => 'AdminController',  // Suppression du path complet du nom de la classe
        ]);
    }
}
