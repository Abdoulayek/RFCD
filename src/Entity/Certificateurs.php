<?php

namespace App\Entity;

use App\Repository\CertificateursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CertificateursRepository::class)]
class Certificateurs
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
    private $Experiences;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'certificateurs')]
    private $RelationCertificateur;

    public function __construct()
    {
        $this->RelationCertificateur = new ArrayCollection();
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

    public function getExperiences(): ?string
    {
        return $this->Experiences;
    }

    public function setExperiences(string $Experiences): self
    {
        $this->Experiences = $Experiences;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getRelationCertificateur(): Collection
    {
        return $this->RelationCertificateur;
    }

    public function addRelationCertificateur(User $relationCertificateur): self
    {
        if (!$this->RelationCertificateur->contains($relationCertificateur)) {
            $this->RelationCertificateur[] = $relationCertificateur;
        }

        return $this;
    }

    public function removeRelationCertificateur(User $relationCertificateur): self
    {
        $this->RelationCertificateur->removeElement($relationCertificateur);

        return $this;
    }
}
