<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WishController extends AbstractController{
    #[Route('/wish', name: 'app_front_office_wish')]
    public function index(): Response
    {
        return $this->render('front_office/wish/wish.html.twig', [
            'controller_name' => 'FrontOffice/WishController',
        ]);
    }
}
