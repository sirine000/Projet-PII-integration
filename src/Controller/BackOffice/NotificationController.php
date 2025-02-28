<?php

namespace App\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class NotificationController extends AbstractController{
    #[Route('/notification', name: 'app_back_office_notification')]
    public function index(): Response
    {
        return $this->render('back_office/notification/notifications.html.twig', [
            'controller_name' => 'BackOffice/NotificationController',
        ]);
    }
}
