<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $titre = null;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?Professeur $professeur_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getProfesseurId(): ?Professeur
    {
        return $this->professeur_id;
    }

    public function setProfesseurId(?Professeur $professeur_id): static
    {
        $this->professeur_id = $professeur_id;

        return $this;
    }
}
