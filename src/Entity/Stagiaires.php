<?php

namespace App\Entity;

use App\Repository\StagiairesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StagiairesRepository::class)]
class Stagiaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $Prenom;

    #[ORM\Column(type: 'string', length: 255)]
    private $Email;

    #[ORM\Column(type: 'string', length: 255)]
    private $Profil;

    #[ORM\OneToMany(mappedBy: 'stagiaires', targetEntity: User::class)]
    private $RelationStagiaire;

    public function __construct()
    {
        $this->RelationStagiaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getProfil(): ?string
    {
        return $this->Profil;
    }

    public function setProfil(string $Profil): self
    {
        $this->Profil = $Profil;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getRelationStagiaire(): Collection
    {
        return $this->RelationStagiaire;
    }

    public function addRelationStagiaire(User $relationStagiaire): self
    {
        if (!$this->RelationStagiaire->contains($relationStagiaire)) {
            $this->RelationStagiaire[] = $relationStagiaire;
            $relationStagiaire->setStagiaires($this);
        }

        return $this;
    }

    public function removeRelationStagiaire(User $relationStagiaire): self
    {
        if ($this->RelationStagiaire->removeElement($relationStagiaire)) {
            // set the owning side to null (unless already changed)
            if ($relationStagiaire->getStagiaires() === $this) {
                $relationStagiaire->setStagiaires(null);
            }
        }

        return $this;
    }
}
