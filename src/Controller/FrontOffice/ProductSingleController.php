<?php

namespace App\Controller\FrontOffice;

use App\Repository\ProduitStoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductSingleController extends AbstractController{
    #[Route('/product_single', name: 'app_front_office_product_single')]
    public function index(): Response
    {
        return $this->render('front_office/product_single/product_single.html.twig', [
            'controller_name' => 'FrontOffice/ProductSingleController',
        ]);
    }


    #[Route('/product_single/{id}', name: 'app_front_office_product_single')]
    public function indexxxx(int $id, ProduitStoreRepository $produitRepository): Response
    {
        $produit = $produitRepository->find($id);

        if (!$produit) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        return $this->render('front_office/product_single/product_single.html.twig', [
            'produit' => $produit,
        ]);
    }




}
