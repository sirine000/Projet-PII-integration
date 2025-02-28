<?php

namespace App\Controller;

use App\Entity\ProduitStore;
use App\Form\ProduitStoreType;
use App\Repository\ProduitStoreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/produitstore')]
final class ProduitstoreController extends AbstractController
{
    #[Route(name: 'app_produitstore_index', methods: ['GET'])]
    public function index(ProduitStoreRepository $produitStoreRepository): Response
    {
        return $this->render('produitstore/index.html.twig', [
            'produit_stores' => $produitStoreRepository->findAll(),
        ]);
    }

    // #[Route('/new', name: 'app_produitstore_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $produitStore = new ProduitStore();
    //     $form = $this->createForm(ProduitStoreType::class, $produitStore);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($produitStore);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_produitstore_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('produitstore/new.html.twig', [
    //         'produit_store' => $produitStore,
    //         'form' => $form,
    //     ]);
    // }
    #[Route('/new', name: 'app_produitstore_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $produitStore = new ProduitStore();
        $form = $this->createForm(ProduitStoreType::class, $produitStore);
        $form->handleRequest($request);
    
        // Vérification de la soumission et validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer le fichier image
            $imageFile = $form->get('path_img')->getData();
    
            // Vérification si le fichier image a bien été sélectionné
            if ($imageFile) {
                // Générer un nom de fichier unique
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
    
                try {
                    // Déplacer le fichier vers le répertoire images
                    $imageFile->move(
                        $this->getParameter('uploads_directory'), // Assurez-vous que ce paramètre est bien défini dans services.yaml
                        $newFilename
                    );
    
                    // Mettre à jour l'attribut 'path_img' de l'entité avec le nouveau nom de fichier
                    $produitStore->setPathImg($newFilename);
                } catch (FileException $e) {
                    // Gérer l'exception si le fichier ne peut pas être déplacé
                    $this->addFlash('error', 'Erreur lors du téléchargement de l\'image.');
                    return $this->redirectToRoute('app_produitstore_new');
                }
            } else {
                // Si l'image n'est pas présente, ajouter un message d'erreur
                $this->addFlash('error', 'Veuillez sélectionner une image.');
                return $this->redirectToRoute('app_produitstore_new');
            }
    
            // Sauvegarde en base de données
            $entityManager->persist($produitStore);
            $entityManager->flush();
    
            // Ajouter un message de succès
            $this->addFlash('success', 'Produit ajouté avec succès !');
            return $this->redirectToRoute('app_produitstore_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('produitstore/new.html.twig', [
            'produit_store' => $produitStore,
            'form' => $form,
        ]);
    }
    



    #[Route('/{id}', name: 'app_produitstore_show', methods: ['GET'])]
    public function show(ProduitStore $produitStore): Response
    {
        return $this->render('produitstore/show.html.twig', [
            'produit_store' => $produitStore,
        ]);
    }

    // #[Route('/{id}/edit', name: 'app_produitstore_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, ProduitStore $produitStore, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(ProduitStoreType::class, $produitStore);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_produitstore_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('produitstore/edit.html.twig', [
    //         'produit_store' => $produitStore,
    //         'form' => $form,
    //     ]);
    // }



    #[Route('/{id}/edit', name: 'app_produitstore_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProduitStore $produitStore, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProduitStoreType::class, $produitStore);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer le fichier de l'image
            $imageFile = $form->get('path_img')->getData();
    
            if ($imageFile) {
                // Supprimer l'ancienne image si elle existe
                if ($produitStore->getPathImg()) {
                    $oldImagePath = $this->getParameter('uploads_directory') . '/' . $produitStore->getPathImg();
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
    
                // Générer un nom unique pour la nouvelle image
                $newFileName = uniqid() . '.' . $imageFile->guessExtension();
    
                // Déplacer l'image vers le dossier de stockage
                $imageFile->move(
                    $this->getParameter('uploads_directory'), // Dossier de destination
                    $newFileName
                );
    
                // Mettre à jour l'entité avec le nouveau nom de fichier
                $produitStore->setPathImg($newFileName);
            }
    
            // Sauvegarde en base de données
            $entityManager->flush();
    
            return $this->redirectToRoute('app_produitstore_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('produitstore/edit.html.twig', [
            'produit_store' => $produitStore,
            'form' => $form,
        ]);
    }
    




    #[Route('/{id}', name: 'app_produitstore_delete', methods: ['POST'])]
    public function delete(Request $request, ProduitStore $produitStore, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produitStore->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($produitStore);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produitstore_index', [], Response::HTTP_SEE_OTHER);
    }
}
