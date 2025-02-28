<?php

namespace App\Entity;

use App\Repository\ProduitEnchereRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ProduitEnchereRepository::class)]

class ProduitEnchere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $quantie = null;

    #[ORM\Column(length: 255)]
    private ?string $path_img = null;

    #[ORM\ManyToOne(inversedBy: 'produitEncheres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $agriculteur_id = null;

    #[ORM\ManyToOne(inversedBy: 'produitEncheres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantie(): ?int
    {
        return $this->quantie;
    }

    public function setQuantie(int $quantie): static
    {
        $this->quantie = $quantie;

        return $this;
    }

    public function getPathImg(): ?string
    {
        return $this->path_img;
    }

    public function setPathImg(string $path_img): static
    {
        $this->path_img = $path_img;

        return $this;
    }

    public function getAgriculteurId(): ?User
    {
        return $this->agriculteur_id;
    }

    public function setAgriculteurId(?User $agriculteur_id): static
    {
        $this->agriculteur_id = $agriculteur_id;

        return $this;
    }

    public function getCategorieId(): ?Categorie
    {
        return $this->categorie_id;
    }

    public function setCategorieId(?Categorie $categorie_id): static
    {
        $this->categorie_id = $categorie_id;

        return $this;
    }
}
