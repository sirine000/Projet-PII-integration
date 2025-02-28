<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]

class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    /**
     * @var Collection<int, ProduitStore>
     */
    #[ORM\OneToMany(targetEntity: ProduitStore::class, mappedBy: 'categorie_id')]
    private Collection $produitStores;

    /**
     * @var Collection<int, ProduitEnchere>
     */
    #[ORM\OneToMany(targetEntity: ProduitEnchere::class, mappedBy: 'categorie_id')]
    private Collection $produitEncheres;

    public function __construct()
    {
        $this->produitStores = new ArrayCollection();
        $this->produitEncheres = new ArrayCollection();
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

    /**
     * @return Collection<int, ProduitStore>
     */
    public function getProduitStores(): Collection
    {
        return $this->produitStores;
    }

    public function addProduitStore(ProduitStore $produitStore): static
    {
        if (!$this->produitStores->contains($produitStore)) {
            $this->produitStores->add($produitStore);
            $produitStore->setCategorieId($this);
        }

        return $this;
    }

    public function removeProduitStore(ProduitStore $produitStore): static
    {
        if ($this->produitStores->removeElement($produitStore)) {
            // set the owning side to null (unless already changed)
            if ($produitStore->getCategorieId() === $this) {
                $produitStore->setCategorieId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProduitEnchere>
     */
    public function getProduitEncheres(): Collection
    {
        return $this->produitEncheres;
    }

    public function addProduitEnchere(ProduitEnchere $produitEnchere): static
    {
        if (!$this->produitEncheres->contains($produitEnchere)) {
            $this->produitEncheres->add($produitEnchere);
            $produitEnchere->setCategorieId($this);
        }

        return $this;
    }

    public function removeProduitEnchere(ProduitEnchere $produitEnchere): static
    {
        if ($this->produitEncheres->removeElement($produitEnchere)) {
            // set the owning side to null (unless already changed)
            if ($produitEnchere->getCategorieId() === $this) {
                $produitEnchere->setCategorieId(null);
            }
        }

        return $this;
    }
}
