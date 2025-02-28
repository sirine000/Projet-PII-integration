<?php

namespace App\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TableController extends AbstractController{
    #[Route('/table', name: 'app_back_office_table')]
    public function index(): Response
    {
        return $this->render('back_office/tables/tables.html.twig', [
            'controller_name' => 'BackOffice/TableController',
        ]);
    }
}
