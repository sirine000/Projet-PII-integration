<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController{
    #[Route('/contact', name: 'app_front_office_contact')]
    public function index(): Response
    {
        return $this->render('front_office/contact/contact.html.twig', [
            'controller_name' => 'FrontOffice/ContactController',
        ]);
    }
}
