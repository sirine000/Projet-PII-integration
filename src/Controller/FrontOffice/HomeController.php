<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController{
    #[Route('/', name: 'app_front_office_home')]
    public function index(): Response
    {
        return $this->render('front_office/home/home.html.twig', [
            'controller_name' => 'FrontOffice/HomeController',
        ]);
    }
}
