<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
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
    private $Certificateur_choisi;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: User::class)]
    private $RelationUser;

    #[ORM\OneToOne(targetEntity: Certificateurs::class, cascade: ['persist', 'remove'])]
    private $RelationCertif;

    public function __construct()
    {
        $this->RelationUser = new ArrayCollection();
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

    public function getCertificateurChoisi(): ?string
    {
        return $this->Certificateur_choisi;
    }

    public function setCertificateurChoisi(string $Certificateur_choisi): self
    {
        $this->Certificateur_choisi = $Certificateur_choisi;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getRelationUser(): Collection
    {
        return $this->RelationUser;
    }

    public function addRelationUser(User $relationUser): self
    {
        if (!$this->RelationUser->contains($relationUser)) {
            $this->RelationUser[] = $relationUser;
            $relationUser->setContact($this);
        }

        return $this;
    }

    public function removeRelationUser(User $relationUser): self
    {
        if ($this->RelationUser->removeElement($relationUser)) {
            // set the owning side to null (unless already changed)
            if ($relationUser->getContact() === $this) {
                $relationUser->setContact(null);
            }
        }

        return $this;
    }

    public function getRelationCertif(): ?Certificateurs
    {
        return $this->RelationCertif;
    }

    public function setRelationCertif(?Certificateurs $RelationCertif): self
    {
        $this->RelationCertif = $RelationCertif;

        return $this;
    }

    public function getP(): ?string
    {
        return $this->P;
    }

    public function setP(string $P): self
    {
        $this->P = $P;

        return $this;
    }
}
