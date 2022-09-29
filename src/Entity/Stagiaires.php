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

    #[ORM\Column(type: 'string', length: 255)]
    private $Prof;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'Relation')]
    #[ORM\JoinColumn(nullable: false)]
    private $Relationuser;

   

    public function __construct()
    {
        $this->RelationStagiaire = new ArrayCollection();
        $this->user = new ArrayCollection();
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

    public function getRelationuser(): ?User
    {
        return $this->Relationuser;
    }

    public function setRelationuser(?User $Relationuser): self
    {
        $this->Relationuser = $Relationuser;

        return $this;
    }

    public function getProf(): ?string
    {
        return $this->Prof;
    }

    public function setProf(string $Prof): self
    {
        $this->Prof = $Prof;

        return $this;
    }

    
}
