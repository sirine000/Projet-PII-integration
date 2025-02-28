<?php

namespace App\Entity;

use App\Repository\EnchereRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: EnchereRepository::class)]
#[Broadcast]
class Enchere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $derniere_prix = null;

    #[ORM\ManyToOne(inversedBy: 'encheres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_gagnant = null;

    #[ORM\ManyToOne(inversedBy: 'encheres_agriculteur')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_agriculteur = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProduitEnchere $id_Produit_enchere = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDernierePrix(): ?float
    {
        return $this->derniere_prix;
    }

    public function setDernierePrix(float $derniere_prix): static
    {
        $this->derniere_prix = $derniere_prix;

        return $this;
    }

    public function getIdGagnant(): ?User
    {
        return $this->id_gagnant;
    }

    public function setIdGagnant(?User $id_gagnant): static
    {
        $this->id_gagnant = $id_gagnant;

        return $this;
    }

    public function getIdAgriculteur(): ?User
    {
        return $this->id_agriculteur;
    }

    public function setIdAgriculteur(?User $id_agriculteur): static
    {
        $this->id_agriculteur = $id_agriculteur;

        return $this;
    }

    public function getIdProduitEnchere(): ?ProduitEnchere
    {
        return $this->id_Produit_enchere;
    }

    public function setIdProduitEnchere(ProduitEnchere $id_Produit_enchere): static
    {
        $this->id_Produit_enchere = $id_Produit_enchere;

        return $this;
    }
}
