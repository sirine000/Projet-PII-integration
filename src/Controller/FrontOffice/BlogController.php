<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogController extends AbstractController{
    #[Route('/blog', name: 'app_front_office_blog')]
    public function index(): Response
    {
        return $this->render('front_office/blog/blog.html.twig', [
            'controller_name' => 'FrontOffice/blogController',
        ]);
    }
}
