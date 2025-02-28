<?php

namespace App\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FormController extends AbstractController{
    #[Route('/form', name: 'app_back_office_form')]
    public function index(): Response
    {
        return $this->render('back_office/forms/forms.html.twig', [
            'controller_name' => 'BackOffice/FormController',
        ]);
    }
}
