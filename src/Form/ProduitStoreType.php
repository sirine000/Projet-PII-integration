<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Panier;
use App\Entity\ProduitStore;
use App\Entity\User;
use Symfony\Component\Validator\Constraints\File; 
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File as FileFile;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitStoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'label' => 'Nom du produit',
            'required' => true,
            'attr' => ['placeholder' => 'Entrez le nom du produit']
        ])
        ->add('description', TextareaType::class, [
            'label' => 'Description',
            'required' => true,
            'attr' => ['placeholder' => 'Décrivez le produit']
        ])
        ->add('quantite', NumberType::class, [
            'label' => 'Quantité',
            'required' => true,
            'attr' => ['min' => 0, 'step' => 1]
        ])
        ->add('prix', NumberType::class, [
            'label' => 'Prix',
            'required' => true,
            'attr' => ['min' => 0, 'step' => 0.01]
        ])
        ->add('path_img', FileType::class, [
           'label' => 'Image du produit',
    'mapped' => false,
    'required' => false,
    'attr' => ['onchange' => 'previewImage(event)'],
    'constraints' => [
        new File([
            'maxSize' => '2M',
            'mimeTypes' => ['image/jpeg', 'image/png', 'image/jpg'],
            'mimeTypesMessage' => 'Veuillez uploader une image valide (JPG, PNG)',
        ])
    ],
])
        ->add('categorie_id', EntityType::class, [
            'class' => Categorie::class,
            'choice_label' => 'nom',
            'label' => 'Catégorie',
            'placeholder' => 'Sélectionnez une catégorie'
        ])
          
;
            // ->add('agriculteur_nom', TextType::class, [
            //     'label' => 'Nom de l\'agriculteur',
            //     'required' => true,
            //     'mapped' => false, // Ne mappe pas directement ce champ à l'entité ProduitStore
            // ])
            
            // ->add('categorie_id', EntityType::class, [
            //     'class' => Categorie::class,
            //     'choice_label' => 'nom', // Affiche le nom de la catégorie
            //     'attr' => ['class' => 'form-input'],
            // ]);
        //     ->add('paniers', EntityType::class, [
        //         'class' => Panier::class,
        //         'choice_label' => 'id',
        //         'multiple' => true,
        //     ])
        // ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProduitStore::class,
        ]);
    }
}
