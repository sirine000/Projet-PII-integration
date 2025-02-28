<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CheckoutController extends AbstractController{
    #[Route('/checkout', name: 'app_front_office_checkout')]
    public function index(): Response
    {
        return $this->render('front_office/checkout/checkout.html.twig', [
            'controller_name' => 'FrontOffice/CheckoutController',
        ]);
    }
}
