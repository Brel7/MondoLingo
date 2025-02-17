<?php

namespace App\Entity;

use App\Repository\ApprenantsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApprenantsRepository::class)]
class Apprenants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $niveau = null;

    #[ORM\Column(length: 30)]
    private ?string $langues_apprises = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getLanguesApprises(): ?string
    {
        return $this->langues_apprises;
    }

    public function setLanguesApprises(string $langues_apprises): static
    {
        $this->langues_apprises = $langues_apprises;

        return $this;
    }
}
