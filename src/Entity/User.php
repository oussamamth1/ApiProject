<?php
declare(strict_types=1);
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ApiFilter(SearchFilter::class, properties={"email": "exact", "nomp": "exact", "email": "partial"})
 * 
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource(formats={"json"},
 * collectionOperations={
 *           "post",
 *          "get"={"normalization_context"={"groups"="read"}},
 *     },
 *   normalizationContext={"groups"={"get"}},
 *     itemOperations={
 *         "put",
 *          "patch",
 *           "delete",
 *         "get"={
 *             "normalization_context"={"groups"={"read_details"}}
 *         }
 *     })
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
  use ResourceId;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"read_details","read","Artical_read_details","readProducts","readProducts_details"})
     *  @Assert\Length(min=5, max=20)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"read_details","read","Artical_read_details","readProducts","readProducts_details"})
     *
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Length(min=5, max=20)
     */
    private $password;
    private $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity=Artical::class, mappedBy="Author")
     * @Groups({"read_details","read","Artical_read_details","readProducts","readProducts_details"})

     */
    private $articals;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read_details","read","Artical_read_details","readProducts","readProducts_details"})
     * 
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read_details","read","Artical_read_details","readProducts","readProducts_details"})
     * @Assert\Length(min=5, max=20)
     */
    private $ville;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read_details","read","Artical_read_details","readProducts","readProducts_details"})
     * @Assert\Length(min=5, max=20)
     */
    private $numberphone;

    /**
     * @ORM\OneToMany(targetEntity=Produits::class, mappedBy="publisher")
     */
    private $produits;

    public function __construct()
    {
        $this->articals = new ArrayCollection();
        $this->createdAt=new \DateTimeImmutable();
        $this->produits = new ArrayCollection();
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
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
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
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }
     /**
    *@return mixed 
   */
	function getPlainPassword() { 
      return $this->plainPassword; 
      } 
      /**
      *@return mixed $planPassword
     */
      function setPlainPassword($plainPassword):void { 
            $this->plainPassword=$plainPassword; 
      }

      /**
       * @return Collection|Artical[]
       */
      public function getArticals(): Collection
      {
          return $this->articals;
      }

      public function addArtical(Artical $artical): self
      {
          if (!$this->articals->contains($artical)) {
              $this->articals[] = $artical;
              $artical->setAuthor($this);
          }

          return $this;
      }

      public function removeArtical(Artical $artical): self
      {
          if ($this->articals->removeElement($artical)) {
              // set the owning side to null (unless already changed)
              if ($artical->getAuthor() === $this) {
                  $artical->setAuthor(null);
              }
          }

          return $this;
      }

      public function isVerified(): bool
      {
          return $this->isVerified;
      }

      public function setIsVerified(bool $isVerified): self
      {
          $this->isVerified = $isVerified;

          return $this;
      }

      public function getVille(): ?string
      {
          return $this->ville;
      }

      public function setVille(string $ville): self
      {
          $this->ville = $ville;

          return $this;
      }

      public function getNumberphone(): ?int
      {
          return $this->numberphone;
      }

      public function setNumberphone(int $numberphone): self
      {
          $this->numberphone = $numberphone;

          return $this;
      }

      /**
       * @return Collection|Produits[]
       */
      public function getProduits(): Collection
      {
          return $this->produits;
      }

      public function addProduit(Produits $produit): self
      {
          if (!$this->produits->contains($produit)) {
              $this->produits[] = $produit;
              $produit->setPublisher($this);
          }

          return $this;
      }

      public function removeProduit(Produits $produit): self
      {
          if ($this->produits->removeElement($produit)) {
              // set the owning side to null (unless already changed)
              if ($produit->getPublisher() === $this) {
                  $produit->setPublisher(null);
              }
          }

          return $this;
      }
   
}
