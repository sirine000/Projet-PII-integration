<?php

namespace App\Controller\FrontOffice;

use App\Entity\ProduitStore;
use App\Repository\CategorieRepository;
use App\Repository\ProduitStoreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class  ShopController extends AbstractController
{

    #[Route('/shop', name: 'app_front_office_shop')]

    public function index(): Response
    {


        return $this->render('front_office/shop/shop.html.twig', [
            'controller_name' => 'FrontOffice/ShopController',
        ]);
    }

    // #[Route('/shop', name: 'app_front_office_shop')]

    // // #[Route('/shop', name: 'app_front_office_shop')]

    // private $entityManager;

    // public function __construct(EntityManagerInterface $entityManager)
    // {
    //     $this->entityManager = $entityManager;
    // }

    /**
     * @Route("/produit/{id}", name="produit_show")
     */


    // public function show(int $id): Response
    // {
    //     $produitStore = $this->entityManager->getRepository(ProduitStore::class)->find($id);

    //     if (!$produitStore) {
    //         throw $this->createNotFoundException('Produit not found');
    //     }

    //     // Make sure to pass the 'produitStore' variable to the template
    //     return $this->render('front_office/shop/show.html.twig', [
    //         'produitStore' => $produitStore,  // Passing the variable here
    //     ]);
    // }


    // #[Route('/product_single/{id}', name: 'app_front_office_product_single')]
    // public function indexx(int $id): Response
    // {
    //     $produitStore = $this->entityManager->getRepository(ProduitStore::class)->find($id);

    //     if (!$produitStore) {
    //         throw $this->createNotFoundException('Produit not found');
    //     }

    //     return $this->render('front_office/product_single/product_single.html.twig', [
    //         'produitStore' => $produitStore,
    //     ]);
    
    // }

    #[Route('/shop', name: 'app_front_office_shop')]
    public function indexe(ProduitStoreRepository $produitRepository): Response
    {
        return $this->render('front_office/shop/shop.html.twig', [
            'produitt' => $produitRepository->findAll(),
        ]);
    }


    // #[Route('/shop', name: 'app_front_office_shop')]
    // public function indexes(CategorieRepository $categorieRepository): Response
    // {
    //     return $this->render('front_office/shop/shop.html.twig', [
    //         'categories' => $categorieRepository->findAll(),
    //     ]);
    // }


// In your ShopController.php
#[Route('/shop', name: 'app_front_office_shopp')]
public function indeeex(CategorieRepository $categorieRepository, ProduitStoreRepository $produitRepository)
{
    // Fetch the list of categories
    $categories = $categorieRepository->findAll();

    // Pass the categories to the Twig template
    return $this->render('front_office/shop/shop.html.twig', [
        'categories' => $categories,  // Passing categories to the template
    ]);
}
#[Route('/shopp/{id}', name: 'app_front_office_shoppp')]
/**
 * @Route("/shop/{id}", name="app_front_office_shoppp")
 */
public function showProductsByCategory($id, ProduitStoreRepository $produitRepository, CategorieRepository $categorieRepository): Response
{
    $categories = $categorieRepository->findAll(); 
    // $produits = $produitRepository->findBy(['categories' => $id]); 
 
    if ($id) {
        $produits = $produitRepository->findBy(['categorie' => $id]); // Produits de la catégorie sélectionnée
    } else {
        $produits = $produitRepository->findAll(); // Tous les produits si aucune catégorie sélectionnée
    }
    return $this->render('front_office/shop.html.twig', [
        'categories' => $categories,
        'produitt' => $produits,
        'currentCategoryId' => $id
    ]);
}


// #[Route('/shop', name: 'app_front_office_shopp')]
// public function indeex(CategorieRepository $categorieRepository, ProduitStoreRepository $produitRepository): Response
// {
//     // Récupérer les produits et les catégories
//     $produits = $produitRepository->findAll();
//     $categories = $categorieRepository->findAll(); // Assurez-vous de récupérer les catégories

//     // Passer les variables à la vue
//     return $this->render('front_office/shop/shop.html.twig', [
//         'produits' => $produits,
//         'categg' => $categories, // Assurez-vous que 'categg' correspond bien ici
//     ]);
// }

}
