<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
#[Broadcast]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $is_etat = null;

    /**
     * @var Collection<int, Commande>
     */
    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'livraison')]
    private Collection $id_commande;

    #[ORM\ManyToOne(inversedBy: 'livraisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Transporteur $id_transporteur = null;

    public function __construct()
    {
        $this->id_commande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isEtat(): ?bool
    {
        return $this->is_etat;
    }

    public function setIsEtat(bool $is_etat): static
    {
        $this->is_etat = $is_etat;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getIdCommande(): Collection
    {
        return $this->id_commande;
    }

    public function addIdCommande(Commande $idCommande): static
    {
        if (!$this->id_commande->contains($idCommande)) {
            $this->id_commande->add($idCommande);
            $idCommande->setLivraison($this);
        }

        return $this;
    }

    public function removeIdCommande(Commande $idCommande): static
    {
        if ($this->id_commande->removeElement($idCommande)) {
            // set the owning side to null (unless already changed)
            if ($idCommande->getLivraison() === $this) {
                $idCommande->setLivraison(null);
            }
        }

        return $this;
    }

    public function getIdTransporteur(): ?Transporteur
    {
        return $this->id_transporteur;
    }

    public function setIdTransporteur(?Transporteur $id_transporteur): static
    {
        $this->id_transporteur = $id_transporteur;

        return $this;
    }
}
