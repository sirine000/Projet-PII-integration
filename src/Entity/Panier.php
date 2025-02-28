<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
#[Broadcast]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_client = null;

    /**
     * @var Collection<int, ProduitStore>
     */
    #[ORM\ManyToMany(targetEntity: ProduitStore::class, inversedBy: 'paniers')]
    private Collection $id_produit;

    public function __construct()
    {
        $this->id_produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdClient(): ?User
    {
        return $this->id_client;
    }

    public function setIdClient(User $id_client): static
    {
        $this->id_client = $id_client;

        return $this;
    }

    /**
     * @return Collection<int, ProduitStore>
     */
    public function getIdProduit(): Collection
    {
        return $this->id_produit;
    }

    public function addIdProduit(ProduitStore $idProduit): static
    {
        if (!$this->id_produit->contains($idProduit)) {
            $this->id_produit->add($idProduit);
        }

        return $this;
    }

    public function removeIdProduit(ProduitStore $idProduit): static
    {
        $this->id_produit->removeElement($idProduit);

        return $this;
    }
}
