<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AboutController extends AbstractController{
    #[Route('/about', name: 'app_front_office_about')]
    public function index(): Response
    {
        return $this->render('front_office/about/about.html.twig', [
            'controller_name' => 'FrontOffice/AboutController',
        ]);
    }
}
