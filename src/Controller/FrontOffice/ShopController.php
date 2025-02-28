<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class  ShopController extends AbstractController{
    #[Route('/shop', name: 'app_front_office_shop')]
    public function index(): Response
    {
        return $this->render('front_office/shop/shop.html.twig', [
            'controller_name' => 'FrontOffice/ShopController',
        ]);
    }
}
