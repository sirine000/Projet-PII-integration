<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CartController extends AbstractController{
    #[Route('/cart', name: 'app_front_office_cart')]
    public function index(): Response
    {
        return $this->render('front_office/cart/cart.html.twig', [
            'controller_name' => 'FrontOffice/CartController',
        ]);
    }
}
