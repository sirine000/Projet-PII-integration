<?php

namespace App\Controller\FrontOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogSingleController extends AbstractController{
    #[Route('/blog/single', name: 'app_front_office_blog_single')]
    public function index(): Response
    {
        return $this->render('front_office/blog_single/index.html.twig', [
            'controller_name' => 'FrontOffice/blogSingleController',
        ]);
    }
}
