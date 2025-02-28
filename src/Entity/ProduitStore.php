<?php

namespace App\Entity;

use App\Repository\ProduitStoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitStoreRepository::class)]

class ProduitStore
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
    private ?float $quantite = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $path_img = null;

    #[ORM\ManyToOne(inversedBy: 'produitStores')]
    #[ORM\JoinColumn(nullable: false)]

    private ?User $agriculteur_id = null;

    #[ORM\ManyToOne(inversedBy: 'produitStores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie_id = null;

    /**
     * @var Collection<int, Panier>
     */
    #[ORM\ManyToMany(targetEntity: Panier::class, mappedBy: 'id_produit')]
    private Collection $paniers;

    public function __construct()
    {
        $this->paniers = new ArrayCollection();
    }

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

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

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

    /**
     * @return Collection<int, Panier>
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): static
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers->add($panier);
            $panier->addIdProduit($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): static
    {
        if ($this->paniers->removeElement($panier)) {
            $panier->removeIdProduit($this);
        }

        return $this;
    }
}
