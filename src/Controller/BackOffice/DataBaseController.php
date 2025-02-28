<?php

namespace App\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DataBaseController extends AbstractController{
    #[Route('/database', name: 'app_back_office_data_base')]
    public function index(): Response
    {
        return $this->render('back_office/tables/database.html.twig', [
            'controller_name' => 'BackOffice/DataBaseController',
        ]);
    }
}
