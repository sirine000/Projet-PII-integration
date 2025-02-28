<?php

namespace App\Entity;

use App\Repository\HistoriqueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: HistoriqueRepository::class)]
#[Broadcast]
class Historique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $Offre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOffre(): ?float
    {
        return $this->Offre;
    }

    public function setOffre(float $Offre): static
    {
        $this->Offre = $Offre;

        return $this;
    }
}
