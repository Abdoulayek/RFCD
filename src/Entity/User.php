<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $Nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $Prenom;

    #[ORM\Column(type: 'string', length: 255)]
    private $Adresse;

    #[ORM\Column(type: 'integer')]
    private $Siret;

    #[ORM\Column(type: 'integer')]
    private $Nombre_Stagiaires;

    #[ORM\ManyToOne(targetEntity: Stagiaires::class, inversedBy: 'RelationStagiaire')]
    private $stagiaires;

    #[ORM\ManyToMany(targetEntity: Certificateurs::class, mappedBy: 'RelationCertificateur')]
    private $certificateurs;

    #[ORM\ManyToOne(targetEntity: Contact::class, inversedBy: 'RelationUser')]
    private $contact;

    public function __construct()
    {
        $this->certificateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getSiret(): ?int
    {
        return $this->Siret;
    }

    public function setSiret(int $Siret): self
    {
        $this->Siret = $Siret;

        return $this;
    }

    public function getNombreStagiaires(): ?int
    {
        return $this->Nombre_Stagiaires;
    }

    public function setNombreStagiaires(int $Nombre_Stagiaires): self
    {
        $this->Nombre_Stagiaires = $Nombre_Stagiaires;

        return $this;
    }

    public function getStagiaires(): ?Stagiaires
    {
        return $this->stagiaires;
    }

    public function setStagiaires(?Stagiaires $stagiaires): self
    {
        $this->stagiaires = $stagiaires;

        return $this;
    }

    /**
     * @return Collection<int, Certificateurs>
     */
    public function getCertificateurs(): Collection
    {
        return $this->certificateurs;
    }

    public function addCertificateur(Certificateurs $certificateur): self
    {
        if (!$this->certificateurs->contains($certificateur)) {
            $this->certificateurs[] = $certificateur;
            $certificateur->addRelationCertificateur($this);
        }

        return $this;
    }

    public function removeCertificateur(Certificateurs $certificateur): self
    {
        if ($this->certificateurs->removeElement($certificateur)) {
            $certificateur->removeRelationCertificateur($this);
        }

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }
}
